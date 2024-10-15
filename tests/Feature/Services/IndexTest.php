<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Services\IndexController;
use App\Models\Service;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

test('an unauthenticated user gets the current status code', function (): void {
    getJson(
        uri: action(IndexController::class)
    )->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('an authenticated user get the correct status code', function (): void {
    actingAs(User::factory()->create())->getJson(
        uri: action(IndexController::class)
    )->assertStatus(Response::HTTP_OK);
});

test('an authenticated user can only see their resources', function (): void {
    $user = User::factory()->create();
    Service::factory()->for($user)->count(2)->create();
    Service::factory()->count(10)->create();


    expect(
        value: Service::query()->count()
    )->toEqual(12);

    actingAs($user)->getJson(
        uri: action(IndexController::class)
    )->assertStatus(Response::HTTP_OK)->assertJson(
        fn(AssertableJson $json) => $json
            ->count(key: 'data', length: 2)
            ->etc()
    );
});

test('the response comes in a standard format', function(): void {
    $user = User::factory()->create();
    Service::factory()->for($user)->count(2)->create();

    actingAs($user)->getJson(
        uri: action(IndexController::class)
    )->assertStatus(Response::HTTP_OK)
    // ->dd()
    // ->assertJson(function(AssertableJson $data){
    //     dd($data->first());
    // })
    ->assertJsonStructure([
        'data' => [
            // '*' => [
            //     'id',
            //     'type',
            //     'attributes' => [
            //         'name',
            //         'url',
            //         'created_at'
            //     ],
            //     'links'
            // ]
        ],
        'links',
        'meta'
    ]);
});

// todo('the structure of the response meets the api design expectations');
// todo('the response is paginated', function(): void {
//     $user = User::factory()->create();
//     Service::factory()->for($user)->count(2)->create();

//     actingAs($user)->getJson(
//         uri: action(IndexController::class)
//     )->assertStatus(Response::HTTP_OK)->assertJson(
//         fn(AssertableJson $json) => $json
//             ->each(
//                 fn(AssertableJson $json) => $json
//                 ->has('id')
//                 ->has('type')
//                 ->has('attributes')
//                 ->has('links')
//                 ->etc()
//             )
            
//     );
// });
todo('a user can include additional relationships');
todo('a user can filter their request to get specific data');
todo('a user can sort the results to the order they require');
