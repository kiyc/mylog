<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\UploadUserIcon;

class UploadUserIconTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @dataProvider validationDataProvider
     * 
     * @return void
     */
    public function testValidation($form, $expected)
    {
        $request   = new UploadUserIcon();
        $validator = Validator::make($form, $request->rules(), $request->messages(), $request->attributes());
        $result    = $validator->passes();
        $errors    = $validator->errors();

        $this->assertEquals($expected['response'], $result);
        $this->assertEquals($expected['errors'], $errors->toArray());
    }

    public function validationDataProvider()
    {
        return [
            '必須エラー' => [
                ['icon' => ''],
                [
                    'response' => false,
                    'errors' => [
                        'icon' => ['ユーザアイコンは必ず指定してください。']
                    ]
                ]
            ],
            '非画像エラー'=> [
                ['icon' => UploadedFile::fake()->create('dummy.txt')],
                [
                    'response' => false,
                    'errors' => [
                        'icon' => ['ユーザアイコンには画像ファイルを指定してください。']
                    ]
                ]
            ],
            '正常' => [
                ['icon' => UploadedFile::fake()->image('avatar.jpg')],
                [
                    'response' => true,
                    'errors' => []
                ]
            ],
        ];
    }
}
