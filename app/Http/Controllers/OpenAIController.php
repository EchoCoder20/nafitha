<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use OpenAI\Laravel\Facades\OpenAI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Support\Facades\Log;

class OpenAIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function readExcel()
    {
        $filePath=storage_path('app/excelData/data.xlsx');
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            dd( $data);
        } catch (Exception $e) {
            Log::error('Error reading Excel file: ' . $e->getMessage());
            throw new \RuntimeException('Unable to read Excel file');
        }
    }


    public function result()
    {
        $filePath=storage_path('app/excelData/data.xlsx');
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            // dd( $data);
        } catch (Exception $e) {
            Log::error('Error reading Excel file: ' . $e->getMessage());
            throw new \RuntimeException('Unable to read Excel file');
        }
        $dataString = json_encode($data);
        $client = new Client();
        // $skills = 'البرمجة، التحليل، والرياضيات';
        $skills = [
            [
                "question" => "ما هي المادة الدراسية التي تشعر بأنها الأسهل بالنسبة لك ولماذا؟",
                "student_answer" => [
                    "A) الرياضيات",
                   
                ]
            ],
            [
                "question" => "هل تفضل المواد التي تعتمد على التحليل وحل المشكلات أم تلك التي تعتمد على الحفظ والفهم؟",
                "student_answer" => [
                    "A) التحليل وحل المشكلات",
                   
                ]
            ],
            [
                "question" => "ما النشاط الذي تستمتع به في وقت فراغك؟",
                "student_answer" => [
                    
                    "B) ممارسة الأنشطة الرياضية",
                   
                ]
            ],
            [
                "question" => "هل تفضل التحديات التي تتطلب تفكيرًا منطقيًا أم تلك التي تتطلب إبداعًا وخيالاً؟",
                "student_answer" => [
                  
                    "C) مزيج من الاثنين",
                    
                ]
            ],
            [
                "question" => "هل تفضل العمل ضمن فريق أم تفضل العمل بشكل فردي؟",
                "student_answer" => [
                    "A) ضمن فريق",
                   
                ]
            ],
            [
                "question" => "كيف تتعامل مع المهام التي تتطلب العمل تحت ضغط؟",
                "student_answer" => [
                    "A) أتعامل معها بشكل جيد وأتحمس للتحدي",
                    
                ]
            ]
        ];
        $skillString = json_encode($skills);
        $studentGrades = [
            'اللغة العربية' => 95,
            'اللغة الانجليزية' => 88,
            'التربية الاسلامية' => 90,
            'الدراسات الإجتماعية' => 85,
            'الفيزياء' => 92,
            'الكيمياء' => 89,
            'الاحياء' => 93,
            'الرياضة' => 87,
            'الرياضيات البحته' => 94
        ];
        $grades = json_encode($studentGrades);
        $template = "
بناءً على المعلومات التالية عن الطالب، يرجى اقتراح التخصصات الجامعية الـ 12 الأكثر ملاءمة:
١. المهارات والاهتمامات: $skillString
٢. الأداء الأكاديمي: $grades
٣. بيانات إضافية: $dataString (تتضمن معلومات عن عدد كبير من الطلاب السابقين، بما في ذلك علاماتهم، تخصصاتهم، والجامعات التي درسوا فيها)
المطلوب:
أ. قدم قائمة مرقمة تحتوي على 6 تخصصًا جامعيًا، كل تخصص في سطر جديد.
ب. لكل تخصص، اشرح باختصار (في جملة واحدة) سبب ملاءمته بناءً على مهارات الطالب واهتماماته ودرجاته.
ج. تأكد من تنوع التخصصات المقترحة بحيث تتوافق مع جوانب مختلفة من ملف الطالب.
د. ضع في اعتبارك كلاً من المجالات الدراسية التقليدية والناشئة.
هـ. راعِ إتقان الطالب للغة العربية عند اقتراح التخصصات.
و. استفد من البيانات الإضافية ($dataString) لتعزيز دقة توصياتك، مع مراعاة اتجاهات التخصصات والجامعات الشائعة بين الطلاب السابقين.
عند تقديم اقتراحاتك، يرجى مراعاة ما يلي:
١. تحليل نقاط القوة والضعف في الأداء الأكاديمي للطالب.
٢. ربط المهارات والاهتمامات بشكل مباشر مع التخصصات المقترحة.
٣. الأخذ بعين الاعتبار الاتجاهات الحالية في سوق العمل والمجالات الواعدة.
٤. تقديم مزيج متوازن من التخصصات العلمية والإنسانية والفنية، حسب ما يتناسب مع ملف الطالب.
٥. الاستفادة من معلومات الجامعات في البيانات الإضافية لاقتراح تخصصات متوفرة في جامعات مناسبة للطالب.
يرجى تقديم قائمتك المقترحة مع شرح موجز لكل تخصص، مع التركيز على الدقة والشمولية في توصياتك، واستخدام البيانات الإضافية لدعم اختياراتك.

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
                                ['role' => 'system', 'content' => 'You are a career advisor helping 12th-grade students find suitable university majors.'],
                                ['role' => 'user', 'content' => $template],
                                ['role' => 'assistant', 'content' => 'The most suitable 6 majors for you are: 
                                                                        1. [Major 1] - because [reason 1].
                                                                        2. [Major 2] - because [reason 2].
                                                                        3. [Major 3] - because [reason 3].
                                                                        4. [Major 4] - because [reason 4].
                                                                        5. [Major 5] - because [reason 5].
                                                                        6. [Major 6] - because [reason 6].'
                                ]
                            ],

                    'max_tokens' => 1000,
                    'temperature' => 0.5,
                ],
            ]);
        
            $body = json_decode((string) $response->getBody(), true);
            
            dd($body['choices'][0]['message']['content']);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }

        
    }
   
    public function nextQuestion($i)
    {
        $questions = [
            [
                "question" => "هل أنت طالب علمي أو أدبي",
                "options" => [
                    "أ) علمي",
                    "ب) أدبي",
                   
                ]
                ],
            [
                "question" => "ما هي المادة الدراسية التي تشعر بأنها الأسهل بالنسبة لك؟",
                "options" => [
                    "أ) الرياضيات",
                    "ب) العلوم",
                    "ج) اللغة العربية",
                    "د) التاريخ"
                ]
            ],
            [
                "question" => "هل تفضل المواد التي تعتمد على التحليل وحل المشكلات أم تلك التي تعتمد على الحفظ والفهم؟",
                "options" => [
                    "أ) التحليل وحل المشكلات",
                    "ب) الحفظ والفهم",
                    "ج) مزيج بين الاثنين",
                    "د) لا أفضلهما"
                ]
            ],
            [
                "question" => "ما النشاط الذي تستمتع به في وقت فراغك؟",
                "options" => [
                    "أ) القراءة والكتابة",
                    "ب) ممارسة الأنشطة الرياضية",
                    "ج) تعلم البرمجة أو التكنولوجيا",
                    "د) الأعمال اليدوية أو الفنية"
                ]
            ],
            [
                "question" => "هل تفضل التحديات التي تتطلب تفكيرًا منطقيًا أم تلك التي تتطلب إبداعًا وخيالاً؟",
                "options" => [
                    "أ) التفكير المنطقي",
                    "ب) الإبداع والخيال",
                    "ج) مزيج من الاثنين",
                    "د) لا أفضلهما"
                ]
            ],
            [
                "question" => "هل تفضل العمل ضمن فريق أم تفضل العمل بشكل فردي؟",
                "options" => [
                    "أ) ضمن فريق",
                    "ب) بشكل فردي",
                    "ج) يعتمد على المهمة",
                    "د) لا أفضل الاثنين"
                ]
            ],
            [
                "question" => "كيف تتعامل مع المهام التي تتطلب العمل تحت ضغط؟",
                "options" => [
                    "A) أتعامل معها بشكل جيد وأتحمس للتحدي",
                    "B) أحتاج إلى تنظيم وقتي جيدًا للتعامل مع الضغط",
                    "C) أشعر بالتوتر وأفضل العمل في بيئة هادئة",
                    "D) يعتمد على نوع المهمة"
                ]
                ],
            [
                "question" => "كيف تقيم قدرتك في التواصل و التعبير عن الأفكار؟",
                "options" => [
                    "أ) ممتاز",
                    "ب) جيد",
                    "ج) متوسط",
                    "د) ضعيف"
                ]
            ]
        ];
        return response()->json(array('msg'=> $questions[$i]['question'],'options'=>$questions[$i]['options']), 200);

   
    }
    public function submitAnswer(Request $request)
    {
        return response()->json(array('msg'=> 'success'), 200);
    }
    public function chat()
    {  
        $questions=[
            'Hi how are you?',
            'What is your name?',
            'can we play togather?',
            'What major do you think is betther IT or AI?'
        ];
        $stringQuestion=json_encode($questions);
        $template="Answer the students question which is ${stringQuestion} one by one and be funny and kind";
        $client = new Client();
        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                        ['role' => 'user', 'content' =>$template],
                       
                    ],
                    'max_tokens' => 300,
                    'temperature' => 0.5,
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
