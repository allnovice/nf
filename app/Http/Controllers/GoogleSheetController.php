<?php

namespace App\Http\Controllers;

use App\Models\GoogleConnection;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Employee;
use App\Models\SocialLink;

class GoogleSheetController extends Controller
{
public function connect()
{
    return Socialite::driver('google')

->scopes([
    'https://www.googleapis.com/auth/spreadsheets',
    'https://www.googleapis.com/auth/drive.readonly',
])

        ->with([
            'access_type' => 'offline',
            'prompt' => 'consent',
        ])
        ->redirect();
}
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        GoogleConnection::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'access_token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'token_expires_at' => now()->addSeconds($googleUser->expiresIn ?? 3600),
            ]
        );

        return redirect()
            ->route('admin.employees.index')
            ->with('success', 'Google account connected successfully.');
    }
public function testSheets()
{
    $connection = GoogleConnection::where('user_id', Auth::id())->first();

if (!$connection) {
    return view('admin.google.sheets', [
        'sheets' => [],
        'connection' => null,
        'connectedSheet' => null,
    ]);
}

    $client = new \Google\Client();

    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token' => $connection->access_token,
        'refresh_token' => $connection->refresh_token,
        'expires_in' => max(0, now()->diffInSeconds($connection->token_expires_at, false)),
    ]);

    $service = new \Google\Service\Sheets($client);

    dd($service);
}
public function sheets()
{
    $connection = GoogleConnection::where('user_id', Auth::id())->first();

if (!$connection) {
    return view('admin.google.sheets', [
        'sheets' => [],
        'connection' => null,
        'connectedSheet' => null,
    ]);
}

    $client = new \Google\Client();

    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token' => $connection->access_token,
        'refresh_token' => $connection->refresh_token,
        'expires_in' => max(0, now()->diffInSeconds($connection->token_expires_at, false)),
    ]);

    $service = new \Google\Service\Drive($client);

    $response = $service->files->listFiles([
        'q' => "mimeType='application/vnd.google-apps.spreadsheet' and trashed=false",
        'fields' => 'files(id,name,modifiedTime)',
        'orderBy' => 'modifiedTime desc',
    ]);

    $connectedSheet = null;

    if ($connection->spreadsheet_id) {
        foreach ($response->getFiles() as $sheet) {
            if ($sheet->getId() === $connection->spreadsheet_id) {
                $connectedSheet = $sheet;
                break;
            }
        }
    }

    return view('admin.google.sheets', [
        'sheets' => $response->getFiles(),
        'connection' => $connection,
        'connectedSheet' => $connectedSheet,
    ]);
}
public function connectSheet(string $spreadsheetId)
{
    $connection = GoogleConnection::where('user_id', Auth::id())->firstOrFail();

    $connection->update([
        'spreadsheet_id' => $spreadsheetId,
    ]);

    return redirect()
        ->route('admin.google.sheets')
        ->with('success', 'Google Sheet connected successfully.');
}
public function readSheet()
{
    $connection = GoogleConnection::where('user_id', Auth::id())->firstOrFail();

    $client = new \Google\Client();

    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token' => $connection->access_token,
        'refresh_token' => $connection->refresh_token,
        'expires_in' => max(0, now()->diffInSeconds($connection->token_expires_at, false)),
    ]);

    $service = new \Google\Service\Sheets($client);

    $spreadsheet = $service->spreadsheets->get(
        $connection->spreadsheet_id
    );

$range = 'Form Responses 1';

$response = $service->spreadsheets_values->get(
    $connection->spreadsheet_id,
    $range
);

dd($response->getValues());
}
public function sync()
{
    $connection = GoogleConnection::where('user_id', Auth::id())->firstOrFail();

    $client = new \Google\Client();

    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token' => $connection->access_token,
        'refresh_token' => $connection->refresh_token,
        'expires_in' => max(0, now()->diffInSeconds($connection->token_expires_at, false)),
    ]);

    $service = new \Google\Service\Sheets($client);

    $response = $service->spreadsheets_values->get(
        $connection->spreadsheet_id,
        'Form Responses 1'
    );

    $rows = $response->getValues();

    if (empty($rows)) {
        return response()->json([
            'message' => 'No data found.',
        ]);
    }

    $headers = array_map(
        fn ($header) => strtolower(trim($header)),
        $rows[0]
    );

    $socialPlatforms = [
        'facebook',
        'instagram',
        'linkedin',
        'x',
        'github',
        'viber',
        'telegram',
        'messenger',
        'whatsapp',
        'youtube',
        'tiktok',
        'threads',
    ];

    $created = 0;
    $updated = 0;
    $unchanged = 0;
    $skipped = 0;
    $socialUpdated = 0;

    foreach (array_slice($rows, 1) as $row) {

        $data = array_combine(
            $headers,
            array_pad($row, count($headers), null)
        );

        $code = trim($data['code'] ?? '');
        $name = trim($data['name'] ?? '');

        if ($code === '' || $name === '') {
            $skipped++;
            continue;
        }

        $employee = Employee::where('code', $code)->first();

        $employeeData = [
            'code'       => $code,
            'name'       => $name,
            'position'   => $data['position'] ?? null,
            'department' => $data['department'] ?? null,
            'email'      => $data['email'] ?? null,
            'phone'      => $data['phone'] ?? null,
            'bio'        => $data['bio'] ?? null,
        ];

if ($employee) {

    if ($employee->only([
        'code',
        'name',
        'position',
        'department',
        'email',
        'phone',
        'bio',
    ]) === $employeeData) {
        $unchanged++;
    } else {
        $employee->update($employeeData);
        $updated++;
    }

} else {

    $employee = Employee::create($employeeData);
    $created++;

}

foreach ($socialPlatforms as $platform) {

    $url = trim($data[$platform] ?? '');

    $socialLink = SocialLink::where('employee_id', $employee->id)
        ->where('platform', $platform)
        ->first();

    if ($url === '') {
        if ($socialLink) {
            $socialLink->delete();
            $socialUpdated++;
        }

        continue;
    }

    if (!$socialLink) {
        SocialLink::create([
            'employee_id' => $employee->id,
            'platform' => $platform,
            'url' => $url,
        ]);

        $socialUpdated++;
        continue;
    }

    if ($socialLink->url !== $url) {
        $socialLink->update([
            'url' => $url,
        ]);

        $socialUpdated++;
    }
}

    }

    $connection->update([
        'last_synced_at' => now(),
    ]);

    return response()->json([
        'message' => 'Sync completed.',
        'created' => $created,
        'updated' => $updated,
        'unchanged' => $unchanged,
        'skipped' => $skipped,
        'social_updated' => $socialUpdated,
    ]);
}
public function syncForConnection(GoogleConnection $connection)
{
    $client = new \Google\Client();

    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setAccessToken([
        'access_token' => $connection->access_token,
        'refresh_token' => $connection->refresh_token,
        'expires_in' => max(0, now()->diffInSeconds($connection->token_expires_at, false)),
    ]);

    $service = new \Google\Service\Sheets($client);

    $response = $service->spreadsheets_values->get(
        $connection->spreadsheet_id,
        'Form Responses 1'
    );

    $rows = $response->getValues();

    if (empty($rows)) {
        return;
    }

    $headers = array_map(
        fn ($header) => strtolower(trim($header)),
        $rows[0]
    );

    $socialPlatforms = [
        'facebook',
        'instagram',
        'linkedin',
        'x',
        'github',
        'viber',
        'telegram',
        'messenger',
        'whatsapp',
        'youtube',
        'tiktok',
        'threads',
    ];

    foreach (array_slice($rows, 1) as $row) {

        $data = array_combine(
            $headers,
            array_pad($row, count($headers), null)
        );

        $code = trim($data['code'] ?? '');
        $name = trim($data['name'] ?? '');

        if ($code === '' || $name === '') {
            continue;
        }

        $employee = Employee::where('code', $code)->first();

        $employeeData = [
            'code'       => $code,
            'name'       => $name,
            'position'   => $data['position'] ?? null,
            'department' => $data['department'] ?? null,
            'email'      => $data['email'] ?? null,
            'phone'      => $data['phone'] ?? null,
            'bio'        => $data['bio'] ?? null,
        ];

        if ($employee) {
            if ($employee->only([
                'code',
                'name',
                'position',
                'department',
                'email',
                'phone',
                'bio',
            ]) !== $employeeData) {
                $employee->update($employeeData);
            }
        } else {
            $employee = Employee::create($employeeData);
        }

        foreach ($socialPlatforms as $platform) {

            $url = trim($data[$platform] ?? '');

            $socialLink = SocialLink::where('employee_id', $employee->id)
                ->where('platform', $platform)
                ->first();

            if ($url === '') {
                if ($socialLink) {
                    $socialLink->delete();
                }

                continue;
            }

            if (!$socialLink) {
                SocialLink::create([
                    'employee_id' => $employee->id,
                    'platform' => $platform,
                    'url' => $url,
                ]);

                continue;
            }

            if ($socialLink->url !== $url) {
                $socialLink->update([
                    'url' => $url,
                ]);
            }
        }
    }

    $connection->update([
        'last_synced_at' => now(),
    ]);
}
public function disconnectSheet()
{
    $connection = GoogleConnection::where('user_id', Auth::id())
        ->firstOrFail();

    $connection->update([
        'spreadsheet_id' => null,
        'last_synced_at' => null,
    ]);

    return redirect()
        ->route('admin.google.sheets')
        ->with('success', 'Google Sheet disconnected.');
}
public function disconnectGoogle()
{
    $connection = GoogleConnection::where('user_id', Auth::id())
        ->firstOrFail();

    $connection->delete();

    return redirect()
        ->route('admin.google.sheets')
        ->with('success', 'Google account disconnected.');
}
}
