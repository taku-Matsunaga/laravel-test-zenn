<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpDownControllerTest extends TestCase
{
    public function test_CSVアップとダウンロード()
    {
        $upContent = file_get_contents(base_path('tests/fixtures/sample.csv'));

        $file = UploadedFile::fake()->createWithContent('dummy.csv', $upContent);

        $response = $this->post('updown', [
            'upfile' => $file,
        ]);

        $response
            ->assertOk()
            ->assertHeader('Content-Disposition', 'attachment; filename=download.csv')
            ->assertStreamedContent($upContent); // アップロードしたファイルと完全一致するかテスト

        // 項目が多い時は、CSV の全中身までチェックするのは大変な事もあります。
        // そういう時は、大事な箇所の部分チェックでも良いかもしれません。
        $downContent = $response->streamedContent();
        $this->assertStringContainsString('ドラ猫,15', $downContent);
    }
}
