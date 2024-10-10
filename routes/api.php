<?php
/**************************Auth************************************* */

use App\Http\Controllers\API\Auth\RecoveryPasswordController;
use App\Http\Controllers\API\Auth\User\LoginController;
use App\Http\Controllers\API\Auth\User\RegisterController;
use App\Http\Controllers\API\Auth\ValidationNumberController;
use App\Mail\MyEmail;
use App\Services\MsegatSmsService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\ImageController;
use Illuminate\Http\Request;
use Modules\Reservation\Entities\Reservation;
use Pusher\Pusher;
use Pusher\PusherException;
use App\Jobs\ExternalApiJob;
use Modules\Wallet\Entities\Wallet;
use Modules\Auth\Entities\User;

Route::post('/fortest/cancel-verify-phone-number/{id}', function ($id) {
    $user = User::whereId($id)->first();
    if (env('APP_ENV') == 'test'){
        $user->update(['phone_verified_at' => null]);
        return successResponse(0, $user, 'this user not verified for now');
    }else {
        return 'dont do that maybe use this this route wrong think again  ';
    }

});

Route::post('email', function (Request $request) {
    if ($request['type'] == 'welcome' || $request['type'] == 'check-code' || $request['type'] == 'new-reservation' || $request['type'] == 'cancel-reservation' || $request['type'] == 'reminder-reservation' || $request['type'] == 'rescheduling-reservation') {
        Mail::to($request['email'])->send(new General($request));
        return 'done';
    }
    return;
});

Route::get('/send-email',function(){
    $email = new MyEmail();
    $response =Mail::to('ehabpop201789@gmail.com')->send($email);
    return 'email sent successfully';

});

Route::get('/send-phone', function () {

    $reservations = Reservation::where('date', now()->toDateString())
        ->where('start_time', '>=', now()->format('H:i:s'))
        ->where('start_time', '<=', now()->addMinutes(30)->format('H:i:s'))
        ->where('notified', false)
        ->with('doctor:id,phone_no,country_id,email','user')
        ->get();
    dd($reservations);


});
Route::post('/check-number', [ValidationNumberController::class, 'validateNumber']);
Route::post('/check-number-after-login', [ValidationNumberController::class, 'validateNumberLogin']);
Route::get('/check-phone-verify-after-login', [ValidationNumberController::class, 'checkVerifyNumber']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::prefix('register')->group(function () {
    //opertaions reg, login
    Route::post('/check-code', [RegisterController::class, 'checkCodeRegister'])->middleware('auth:api')->name('check-code-register');
    Route::get('/resend-code', [RegisterController::class, 'resendCodeRegister'])->name('resend-code-register');
});

//opertaions recovery-by-password
Route::prefix('recovery-by-password')->group(function () {
    Route::post('forgot-password', [RecoveryPasswordController::class, 'forgotPassword'])->name('forgot-password');
});
Route::prefix('recovery-by-password')->group(function () {
    Route::post('check-code', [RecoveryPasswordController::class, 'checkCodeRecovery'])->name('check-code-pass');
    Route::post('resend-code', [RecoveryPasswordController::class, 'resendCodeRecovery'])->name('resend-code-pass');
    Route::post('reset-password', [RecoveryPasswordController::class, 'resetPassword'])->name('reset-password');
});
// Broadcast::routes();


Route::post('/broadcasting/auth', function (Request $request) {

    try {
        // Create a new Pusher instance with your app credentials

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );
        dd($pusher->socket_id);

        // Subscribe to the channel
        $channel = 'my-channel';
        // $pusher->subscribe($channel);
        $pusher->connection->bind('connected', function () {
            $socket_id = $pusher->connection->socket_id;
            console . log('Socket ID:', socket_id);
        });
        // Listen for the connection established event
        $pusher->on('pusher:subscription_succeeded', function ($data) use ($pusher, $channel) {
            $socket_id = $data['socket_id'];
            // Do something with the socket ID
            echo "Socket ID: $socket_id";

            // Unsubscribe from the channel
            $pusher->unsubscribe($channel);
        });

        // Trigger an event
        $data = ['message' => 'Hello, world!'];
        $pusher->trigger($channel, 'my-event', $data);
        dd($pusher);
    } catch (PusherException $e) {
        // Handle exceptions
        echo "Pusher error: " . $e->getMessage();
    }


// Create a new Pusher instance with your app credentials
    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]
    );

// Trigger an event and get the socket ID
    $data = ['message' => 'Hello, world!'];
    $pusher->trigger('my-channel', 'my-event', $data);
    $socket_id = $pusher->socket_id;

// Do something with the socket ID
    echo "Socket ID: $socket_id";
    dd(0);
    // dd(2);
    // dd(authUser());
    $user = $request->user();
    // dd($user);
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]
    );


    $socketId = $request->input('socket_id');
    $channelName = $request->input('channel_name');
    // dd($channelName);

    $presenceData = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
    ];
// dd($pusher);
// $pusher->trigger('Message.User.5', 'MessageCreated', 'data', [], true);
// $socket_id = $pusher->socket_id;
// dd($socket_id);
//     $auth = $pusher->presence_auth('Message.User.5', '10101', $user->id, $presenceData);

//     return $auth;
});
// Route::post('broadcasting/auth', function () {
//     $socket_id = request()->socket_id;
//     $channel_name = request()->channel_name;
//     $user_id = auth()->id(); // or any other user identifier

//     $pusher = new Pusher\Pusher(
//         env('PUSHER_APP_KEY'),
//         env('PUSHER_APP_SECRET'),
//         env('PUSHER_APP_ID'),
//         [
//             'cluster' => env('PUSHER_APP_CLUSTER'),
//             'useTLS' => true
//         ]
//     );

//     $auth = $pusher->socket_auth($channel_name, $socket_id, $user_id);

//     return response()->json($auth);
// })->middleware('auth');
// Broadcast::routes();


//logout
Route::middleware(['auth:api'])->group(function () {
    Route::delete('/logout', [LoginController::class, 'destroy']);
});
//image
Route::get('/upload-image/{item}/{modelName}/{folderName}', [ImageController::class, 'uploadImage'])->name('file.upload-image');

//home
Route::get('/home', [HomeController::class, 'index'])->name('home.all');
//Lang
Route::get('lang/{lang}', ['as' => 'lang.switch.api', 'uses' => 'App\Http\Controllers\API\LanguageController@switchLang']);
Route::get('get-all-langs', ['as' => 'lang.langs.api', 'uses' => 'App\Http\Controllers\API\LanguageController@getAllLangs']);
Route::get('default-lang', ['as' => 'lang.default-lang.api', 'uses' => 'App\Http\Controllers\API\LanguageController@defaultLang']);

//additinal

Route::get('create-wallet', function () {
    //get all users , doctors doesntHave wallet->will create it for his
    $users = User::doesntHave('wallet')->get();
    foreach ($users as $user) {
        Wallet::create(['user_id' => $user->id, 'balance' => 0]);
    }
    return successResponse(0);
});

Route::get('delete-repeated-wallet', function () {
    $wallets = Wallet::orderBy('id','asc')->get()->toArray();
    $count = count($wallets);
    for ($i=0; $i < $count; $i++ ){
        $h = $i + 1 ;
        for ($h; $h < $count; $h++){
            if ($wallets[$i]['user_id'] == $wallets[$h]['user_id']){
                Wallet::whereId($wallets[$h]['id'])->forceDelete();
            }
        }
    }
    return successResponse(0);
});


