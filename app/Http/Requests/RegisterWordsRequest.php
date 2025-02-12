<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterWordsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 必要であればここで認可ロジックを追加する
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'word' => ['required', 'string', 'max:50'],
            'definition' => ['required', 'string', 'max:50'],
            'partOfSpeech' => ['required', 'int', 'max:50'],
        ];
    }

    /**
     * カスタムエラーメッセージを定義
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'word.required' => '英単語を入力してください。',
            'word.max' => '英単語は50文字以内で入力してください。',
            'definition.required' => '説明を入力してください。',
            'definition.max' => '説明は50文字以内で入力してください。',
            'partOfSpeech' => '品詞を選択してください。',
            'partOfSpeech.int' => '品詞は指定された種類（noun, verb, adjectiveなど）の中から選択してください。',
        ];
    }
}
