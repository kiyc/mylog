<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUser;

class UpdateUserTest extends TestCase
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
        $request   = new UpdateUser();
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
                [
                    'id'       => 1,
                    'name'     => '',
                    'email'    => '',
                    'password' => '',
                ],
                [
                    'response' => false,
                    'errors' => [
                        'name'     => ['氏名は必ず指定してください。'],
                        'email'    => ['メールアドレスは必ず指定してください。'],
                    ]
                ]
            ],
            'パスワードエラー' => [
                [
                    'id'       => 1,
                    'name'     => 'test',
                    'email'    => 'test@example.net',
                    'password' => 'pass',
                ],
                [
                    'response' => false,
                    'errors' => [
                        'password' => ['パスワードは半角英数字6文字以上を指定してください。']
                    ]
                ]
            ],
            '正常' => [
                [
                    'id'       => 1,
                    'name'     => 'test',
                    'email'    => 'test@example.net',
                    'password' => 'passpass',
                ],
                [
                    'response' => true,
                    'errors' => []
                ]
            ],
        ];
    }
}
