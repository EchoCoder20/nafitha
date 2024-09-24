<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use OpenAI\Laravel\Facades\OpenAI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
class OpenAIController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function startQuestionnaire()
    {
        $client = new Client();
        $template = "
        أنت مسؤول عن إدارة استبيان ديناميكي يهدف إلى اكتشاف رغبات، ميول، ومهارات طلاب الصف 12 في سلطنة عمان.
        مهمتك هي طرح أسئلة ذكية ومتعمقة لفهم شخصية الطالب واهتماماته بشكل أفضل.

        إرشادات لصياغة الأسئلة:
        التركيز على مهارات الطالب وشغفه والمواد الدراسية وسماته الشخصية، مع دمج رؤى من أبعاد الشخصية \"الخمسة الكبرى\" (الانفتاح، والضمير، والانبساط، والقبول، والعصابية).

        قواعد صياغة الأسئلة:
        - كل سؤال يجب أن يحتوي على أربعة خيارات (أ، ب، ج، د).
        - الأسئلة يجب أن تكون مصممة بعناية لتجنب التكرار.
        - استند إلى إجابة الطالب للسؤال السابق لتقديم السؤال الأكثر ملاءمة التالي.
        - يجب أن يكون كل سؤال مركزًا ومهنيًا.
        - لا تقدم أي توصيات أو نتائج حتى يتم الانتهاء من جميع الأسئلة.

        السؤال السابق وإجابة الطالب:
        

        بناءً على هذه المعلومات، قم بإنشاء السؤال التالي الذي سيساعد في فهم ميول الطالب ورغباته ومهاراته بشكل أفضل.
        ";

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are an AI assistant designed to generate questions for a dynamic questionnaire.'],
                        ['role' => 'user', 'content' => $template],
                    ],
                    'max_tokens' => 150,
                    'temperature' => 0.7,
                ],
            ]);
        
            $body = json_decode((string) $response->getBody(), true);
            
            dd($body['choices'][0]['message']['content']);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }

        
    }
    public function index()
    {
        //
       
        $current_question="هل أنت طالب علمي و أدبي ؟";
        $options=[
            'علمي',
            'أدبي'
        ];
        return response()->json(array('msg'=> $current_question,'options'=>$options), 200);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
