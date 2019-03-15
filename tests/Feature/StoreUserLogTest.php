<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserLog;

class StoreUserLogTest extends TestCase
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
        $request   = new StoreUserLog();
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
                    'date' => '',
                ],
                [
                    'response' => false,
                    'errors' => [
                        'date' => ['日付は必ず指定してください。'],
                    ]
                ]
            ],
            '日付エラー' => [
                [
                    'date' => 'dummy',
                ],
                [
                    'response' => false,
                    'errors' => [
                        'date' => ['日付には有効な日付を指定してください。'],
                    ]
                ]
            ],
            '正常' => [
                [
                    'date' => date('Y-m-d'),
                ],
                [
                    'response' => true,
                    'errors' => []
                ]
            ],
        ];
    }
}
