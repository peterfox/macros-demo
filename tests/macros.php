<?php

\Illuminate\Foundation\Testing\TestResponse::macro('assertErrorInResponse', function () {
    /** @var $this \Illuminate\Foundation\Testing\TestResponse */
    return $this->assertOk()
        ->assertJsonFragment(['error' => true]);
});