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
use App\Models\Questions;
use App\Models\Marks;
use App\Models\Result;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Cache;
use PDF;


class OpenAIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function result()
    {
        $questions=Questions::where('user_id',1)->get();
        $questionsArray = []; // Initialize an empty array

        foreach ($questions as $question) {
            $questionsArray[] = [
                'question' => $question->question,  // Store the question
                'answer'   => $question->answer     // Store the answer
            ];
        }
        $readableString="";
        foreach ($questionsArray as $index => $qa) {
            $readableString .= ($index + 1) . ". " . $qa['question'] . " إجابة الطالب-: " . $qa['answer'] . "\n";  // Add a newline at the end
        }
        $marks = Marks::where('user_id', 1)->first();
        $marksArray = json_decode($marks->marks, true);
        $readableMark = '';

    
            foreach ($marksArray as $index => $subjectMark) {
                foreach ($subjectMark as $subject => $mark) {
                    // Decode the Unicode subject name
                    $decodedSubject = json_decode('"' . $subject . '"');
                    $readableMark .= "$decodedSubject: $mark \n";
                }
            }
   
        $filePath=storage_path('app/excelData/data.xlsx');
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            $readableFile = '';
            foreach ($data as $row) {
                $readableFile .= implode(", ", $row) . "\n"; // Join row data with commas and add a new line after each row
            }
            // dd( $data);
        } catch (Exception $e) {
            Log::error('Error reading Excel file: ' . $e->getMessage());
            throw new \RuntimeException('Unable to read Excel file');
        }
        
      
        $client = new Client();
       
       
        $template = "
        أريد منك أن تقترح أكثر 6 تخصصات جامعية مناسبة لطالب في الصف الثاني عشر في سلطنة عُمان. يرجى اتباع الخطوات التالية بدقة:

1. تحليل بيانات الطالب:
   - راجع إجابات الطالب على الأسئلة المتعلقة بمهاراته واهتماماته: {$readableString}
   - افحص درجات الطالب في كل مادة للعام الأكاديمي الحالي: {$readableMark}
   - قم بتحليل بيانات طلاب الصف الثاني عشر السابقين من الملف المرفق: {$readableFile}

2. اقتراح التخصصات:
   قدم قائمة مرقمة تحتوي على 6 تخصصات جامعية، مع مراعاة ما يلي:
   - ملاءمة التخصص لمهارات الطالب واهتماماته
   - توافق التخصص مع درجات الطالب في المواد ذات الصلة
   - اتجاهات القبول في الجامعات العُمانية بناءً على بيانات الطلاب السابقين
   - فرص العمل المستقبلية في سلطنة عُمان

3. تبرير الاختيارات:
   لكل تخصص، قدم شرحاً موجزاً (في جملتين كحد أقصى) يوضح:
   - سبب ملاءمة التخصص بناءً على مهارات الطالب واهتماماته
   - كيف يتوافق التخصص مع أداء الطالب الأكاديمي
   - أي اتجاهات ملحوظة من بيانات الطلاب السابقين تدعم هذا الاختيار

4. ترتيب التخصصات:
   رتب التخصصات المقترحة حسب درجة ملاءمتها للطالب، مع الأخذ في الاعتبار جميع العوامل المذكورة أعلاه.

5. ملاحظات إضافية:
   - قدم نصيحة موجزة للطالب حول كيفية الاستعداد للتخصصات المقترحة
   - اذكر أي مهارات إضافية قد تكون مفيدة للطالب لتطويرها قبل دخول الجامعة

يرجى تقديم هذه المعلومات بشكل منظم ومنطقي، مع التأكد من أن جميع التوصيات مدعومة بالبيانات المتاحة وملائمة لسياق التعليم العالي في سلطنة عُمان.
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
                                ['role' => 'assistant', 'content' => 'The result must be displayed like this :The most suitable 6 majors for you are: 
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
           
            return response()->json(array('msg'=> $body['choices'][0]['message']['content']), 200);
           
        } catch (GuzzleException $e) {
            return response()->json(array('error'=> $e,'status' => 'error'), 200);
        }


        
    }


    public function readExcel()
    {
        $marks = Marks::where('user_id', 1)->first();
        $marksArray = json_decode($marks->marks, true);
        dd(json_encode($marksArray));
//         $questions = Questions::where('user_id', 1)->get();
// $questionsArray = $questions->map(function ($question) {
//     return [
//         'question' => $question->question,
//         'answer' => $question->answer
//     ];
// })->toArray();
// $template = "
// Based on the following information about the student, please recommend the 6 most suitable university majors:

// Skills and Interests: " . json_encode($questionsArray) . "";
// dd($template);
        // $filePath=storage_path('app/excelData/newupdate.pdf');
        // $parser = new Parser();
        // $pdf = $parser->parseFile($filePath);
        // $text = $pdf->getText();

        // $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
            
        //     // Remove any non-Arabic characters (optional)
        //     $text = preg_replace('/[^\p{Arabic}\s]/u', '', $text);
            
        //     return response()->json(['text' => $text]);
        // $filePath=storage_path('app/excelData/majors.xlsx');
        // try {
        //     $spreadsheet = IOFactory::load($filePath);
        //     $worksheet = $spreadsheet->getActiveSheet();
        //     $data = $worksheet->toArray();
        //     dd($data);
        //     // $readableString = '';
        //     // foreach ($data as $row) {
        //     //     $readableString .= implode(", ", $row) . "\n"; // Join row data with commas and add a new line after each row
        //     // }
            
        // } catch (Exception $e) {
        //     Log::error('Error reading Excel file: ' . $e->getMessage());
        //     throw new \RuntimeException('Unable to read Excel file');
        // }
//         $filePath = storage_path('app/excelData/majors.xlsx');

// try {
//     $spreadsheet = IOFactory::load($filePath);
//     $allSheetData = [];

//     foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
//         $sheetName = $worksheet->getTitle();
//         $sheetData = $worksheet->toArray(null, true, true, true);
        
//         // Remove empty rows
//         $sheetData = array_filter($sheetData, function($row) {
//             return !empty(array_filter($row, 'strlen'));
//         });

//         $allSheetData[$sheetName] = $sheetData;
//     }

//     // Output or process the data
//     // foreach ($allSheetData as $sheetName => $sheetData) {
//     //     // echo "Sheet: $sheetName\n";
//     //     foreach ($sheetData as $rowIndex => $row) {
//     //         echo "Row $rowIndex: " . implode(", ", $row) . "\n";
//     //     }
//     //     echo "\n";
//     // }
      
//     $output = "";
//         foreach ($allSheetData as $sheetName => $sheetData) {
//             $output .= "Sheet: $sheetName\n";
//             $output .= str_repeat('-', strlen("Sheet: $sheetName")) . "\n";
    
//             // Determine the maximum width for each column
//             $columnWidths = [];
//             foreach ($sheetData as $row) {
//                 foreach ($row as $col => $cell) {
//                     $cellLength = mb_strlen($cell);
//                     if (!isset($columnWidths[$col]) || $cellLength > $columnWidths[$col]) {
//                         $columnWidths[$col] = $cellLength;
//                     }
//                 }
//             }
    
//             // Output the data with aligned columns
//             foreach ($sheetData as $rowIndex => $row) {
//                 foreach ($row as $col => $cell) {
//                     $output .= str_pad($cell, $columnWidths[$col] + 2);
//                 }
//                 $output .= "\n";
//             }
//             $output .= "\n\n";
//         }
//         dd( $output);
//     // If you want to see the full structure, you can use dd()
   

// } catch (Exception $e) {
//     Log::error('Error reading Excel file: ' . $e->getMessage());
//     throw new \RuntimeException('Unable to read Excel file: ' . $e->getMessage());
// }
    }

    
    
    // public function result()
    // {
//         $questions = Questions::where('user_id', 1)->get();
// $questionsArray = $questions->map(function ($question) {
//     return [
//         'question' => $question->question,
//         'answer' => $question->answer
//     ];
// })->toArray();

// $marks = Marks::where('user_id', 1)->first();
// $marksArray = json_decode($marks->marks, true);

// $filePath = storage_path('app/excelData/data.xlsx');
// try {
//     $spreadsheet = IOFactory::load($filePath);
//     $worksheet = $spreadsheet->getActiveSheet();
//     $data = $worksheet->toArray();
// } catch (Exception $e) {
//     Log::error('Error reading Excel file: ' . $e->getMessage());
//     throw new \RuntimeException('Unable to read Excel file');
// }

// $client = new Client();

// $template = "Based on the following information about the student, please recommend the 6 most suitable university majors:

// Information about previous 12 graduated students (marks and majors):
// " . json_encode(array_slice($data, 0, 12), JSON_PRETTY_PRINT) . "

// Please provide a numbered list of 6 majors, each on a new line. For each major, briefly explain (in one sentence) why it's suitable based on the student's skills, interests, and grades.

// Additional considerations:
// 1. Ensure a diverse range of majors that align with various aspects of the student's profile.
// 2. Consider both traditional and emerging fields of study.
// 3. If the student shows preference for practical fields, select majors on the practical side; otherwise, select majors on the theoretical side.

// Give the answer in Arabic language.";

// try {
//     $response = $client->post('https://api.openai.com/v1/chat/completions', [
//         'headers' => [
//             'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//             'Content-Type' => 'application/json',
//         ],
//         'json' => [
//             'model' => 'gpt-4-1106-preview',  // Using the latest GPT-4 model
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You are a career advisor helping 12th-grade students in Oman find suitable university majors. Provide concise, accurate recommendations based on the student\'s profile.'],
//                 ['role' => 'user', 'content' => $template],
//                 ['role' => 'user', 'content' => "Try to know my skills and passion based on my answer for 10 questions provided there " . json_encode($questionsArray, JSON_PRETTY_PRINT) . ""],
//                 ['role' => 'user', 'content' => "And this is my Academic Performance " . json_encode($marksArray, JSON_PRETTY_PRINT) . ""],
//             ],
//             'max_tokens' => 1000,
//             'temperature' => 0.7,
//         ],
//     ]);

//     $body = json_decode((string) $response->getBody(), true);
//     return response()->json(['msg' => $body['choices'][0]['message']['content']], 200);
// } catch (GuzzleException $e) {
//     return response()->json(['error' => $e->getMessage(), 'status' => 'error'], 500);
// }
//         $questions = Questions::where('user_id', 1)->get();
// $questionsArray = $questions->map(function ($question) {
//     return [
//         'question' => $question->question,
//         'answer' => $question->answer
//     ];
// })->toArray();

// $marks = Marks::where('user_id', 1)->first();
// $marksArray = json_decode($marks->marks, true);

// $filePath = storage_path('app/excelData/data.xlsx');
// try {
//     $spreadsheet = IOFactory::load($filePath);
//     $worksheet = $spreadsheet->getActiveSheet();
//     $data = $worksheet->toArray();
// } catch (Exception $e) {
//     Log::error('Error reading Excel file: ' . $e->getMessage());
//     throw new \RuntimeException('Unable to read Excel file');
// }
// $skills=json_encode($questionsArray);
// $grade=json_encode($marksArray);
// $file=json_encode($data);
// $client = new Client();

// $template = "
// Based on the following information about the student, please recommend the 6 most suitable university majors:

// Skills and Interests: $skills

// Academic Performance: $grade

// Information you can take benefit from them which include the marks of the previous 12 graduated students and which major they studied:
// $file

// Please provide a numbered list of 6 majors, each on a new line. For each major, briefly explain (in one sentence) why it's suitable based on the student's skills, interests, and grades.

// Additional considerations:
// 1. Ensure a diverse range of majors that align with various aspects of the student's profile.
// 2. Consider both traditional and emerging fields of study.
// 3. If the students select practical side select for him majors on practical side otherwise select majors on theoretical side.

// Give the answer in Arabic language
// ";

// try {
//     $response = $client->post('https://api.openai.com/v1/chat/completions', [
//         'headers' => [
//             'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//             'Content-Type' => 'application/json',
//         ],
//         'json' => [
//             'model' => 'gpt-4-turbo',
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You are a career advisor helping 12th-grade students find suitable university majors.'],
//                 ['role' => 'user', 'content' => $template],
//                 ['role' => 'assistant', 'content' => 'The result must be displayed like this :The most suitable 6 majors for you are:
//                     1. [Major 1] - because [reason 1].
//                     2. [Major 2] - because [reason 2].
//                     3. [Major 3] - because [reason 3].
//                     4. [Major 4] - because [reason 4].
//                     5. [Major 5] - because [reason 5].
//                     6. [Major 6] - because [reason 6].']
//             ],
//             'max_tokens' => 1000,
//             'temperature' => 0.5,
//         ],
//     ]);

//     $body = json_decode((string) $response->getBody(), true);
//     return response()->json(['msg' => $body['choices'][0]['message']['content']], 200);
// } catch (GuzzleException $e) {
//     return response()->json(['error' => $e->getMessage(), 'status' => 'error'], 500);
// }
    //     $questions=Questions::where('user_id',1)->get();
    //     $questionsArray = []; // Initialize an empty array

    //     foreach ($questions as $question) {
    //         $questionsArray[] = [
    //             'question' => $question->question,  // Store the question
    //             'answer'   => $question->answer     // Store the answer
    //         ];
    //     }
    //     $readableString="";
    //     foreach ($questionsArray as $index => $qa) {
    //         $readableString .= ($index + 1) . ". " . $qa['question'] . " إجابة الطالب-: " . $qa['answer'] . "\n";  // Add a newline at the end
    //     }
    //     $marks = Marks::where('user_id', 1)->first();
    //     $marksArray = json_decode($marks->marks, true);
    //     $readableMark = '';

    
    //         foreach ($marksArray as $index => $subjectMark) {
    //             foreach ($subjectMark as $subject => $mark) {
    //                 // Decode the Unicode subject name
    //                 $decodedSubject = json_decode('"' . $subject . '"');
    //                 $readableMark .= "$decodedSubject: $mark \n";
    //             }
    //         }
   
    //     $filePath=storage_path('app/excelData/data.xlsx');
    //     try {
    //         $spreadsheet = IOFactory::load($filePath);
    //         $worksheet = $spreadsheet->getActiveSheet();
    //         $data = $worksheet->toArray();
    //         $readableFile = '';
    //         foreach ($data as $row) {
    //             $readableFile .= implode(", ", $row) . "\n"; // Join row data with commas and add a new line after each row
    //         }
    //         // dd( $data);
    //     } catch (Exception $e) {
    //         Log::error('Error reading Excel file: ' . $e->getMessage());
    //         throw new \RuntimeException('Unable to read Excel file');
    //     }
        
      
    //     $client = new Client();
       
       
    //     $template = "
    //                 Based on the following information about the student, please recommend the 6 most suitable university majors:

    //         Skills and Interests: ${questionsArray}
    //         Academic Performance: ${marksArray}
    //         Information you can take benefit from them which include the marks of the previous 12 graduated students and which major they studied:${data} .

    //         Please provide a numbered list of 6 majors, each on a new line. For each major, briefly explain (in one sentence) why it's suitable based on the student's skills, interests, and grades.

    //         Additional considerations:
    //         1. Ensure a diverse range of majors that align with various aspects of the student's profile.
    //         2. Consider both traditional and emerging fields of study.
    //         3. If the students select practical side select for him majors on practical side otherwise select majors on theoriacl side.
    //         Give the answer in Arabic language       
    //   ";

    //     try {
    //         $response = $client->post('https://api.openai.com/v1/chat/completions', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'model' => 'gpt-4o',
    //                 'messages' => [
    //                             ['role' => 'system', 'content' => 'You are a career advisor helping 12th-grade students find suitable university majors.'],
    //                             ['role' => 'user', 'content' => $template],
    //                             ['role' => 'assistant', 'content' => 'The result must be displayed like this :The most suitable 6 majors for you are: 
    //                                                                     1. [Major 1] - because [reason 1].
    //                                                                     2. [Major 2] - because [reason 2].
    //                                                                     3. [Major 3] - because [reason 3].
    //                                                                     4. [Major 4] - because [reason 4].
    //                                                                     5. [Major 5] - because [reason 5].
    //                                                                     6. [Major 6] - because [reason 6].'
    //                             ]
    //                         ],

    //                 'max_tokens' => 1000,
    //                 'temperature' => 0.7,
    //             ],
    //         ]);
        
    //         $body = json_decode((string) $response->getBody(), true);
           
    //         return response()->json(array('msg'=> $body['choices'][0]['message']['content']), 200);
           
    //     } catch (GuzzleException $e) {
    //         return response()->json(array('error'=> $e,'status' => 'error'), 200);
    //     }


        
    // }

//     public function result()
// {
//     $userId = 1; // Consider making this dynamic
    
//     // Fetch questions and answers
//     $questions = Questions::where('user_id', $userId)->get();
//     $questionsArray = $questions->map(function ($question) {
//         return [
//             'question' => $question->question,
//             'answer' => $question->answer
//         ];
//     })->toArray();

//     $readableString = collect($questionsArray)->map(function ($qa, $index) {
//         return ($index + 1) . ". " . $qa['question'] . " إجابة الطالب-: " . $qa['answer'];
//     })->implode("\n");

//     // Fetch marks
//     $marks = Marks::where('user_id', $userId)->firstOrFail();
//     $marksArray = json_decode($marks->marks, true);
//     $readableMark = collect($marksArray)->map(function ($subjectMark) {
//         return collect($subjectMark)->map(function ($mark, $subject) {
//             $decodedSubject = json_decode('"' . $subject . '"');
//             return "$decodedSubject: $mark";
//         })->implode("\n");
//     })->implode("\n");

//     // Read Excel file
//     $filePath = storage_path('app/excelData/data.xlsx');
//     try {
//         $spreadsheet = IOFactory::load($filePath);
//         $worksheet = $spreadsheet->getActiveSheet();
//         $data = $worksheet->toArray();
//         $readableFile = collect($data)->map(function ($row) {
//             return implode(", ", $row);
//         })->implode("\n");
//     } catch (Exception $e) {
//         Log::error('Error reading Excel file: ' . $e->getMessage());
//         throw new \RuntimeException('Unable to read Excel file');
//     }

//     // Prepare the prompt
//     $template = "
//    أريد منك أن تقترح أكثر 6 تخصصات جامعية مناسبة لطالب في الصف الثاني عشر في سلطنة عُمان. يرجى اتباع الخطوات التالية بدقة:

// 1. تحليل بيانات الطالب:
//    - راجع إجابات الطالب على الأسئلة المتعلقة بمهاراته واهتماماته: {$readableString}
//    - افحص درجات الطالب في كل مادة للعام الأكاديمي الحالي: {$readableMark}
//    - قم بتحليل بيانات طلاب الصف الثاني عشر السابقين من الملف المرفق: {$readableFile}

// 2. اقتراح التخصصات:
//    قدم قائمة مرقمة تحتوي على 6 تخصصات جامعية، مع مراعاة ما يلي:
//    - ملاءمة التخصص لمهارات الطالب واهتماماته
//    - توافق التخصص مع درجات الطالب في المواد ذات الصلة
//    - اتجاهات القبول في الجامعات العُمانية بناءً على بيانات الطلاب السابقين
//    - فرص العمل المستقبلية في سلطنة عُمان

// 3. تبرير الاختيارات:
//    لكل تخصص، قدم شرحاً موجزاً (في جملتين كحد أقصى) يوضح:
//    - سبب ملاءمة التخصص بناءً على مهارات الطالب واهتماماته
//    - كيف يتوافق التخصص مع أداء الطالب الأكاديمي
//    - أي اتجاهات ملحوظة من بيانات الطلاب السابقين تدعم هذا الاختيار

// 4. ترتيب التخصصات:
//    رتب التخصصات المقترحة حسب درجة ملاءمتها للطالب، مع الأخذ في الاعتبار جميع العوامل المذكورة أعلاه.

// 5. ملاحظات إضافية:
//    - قدم نصيحة موجزة للطالب حول كيفية الاستعداد للتخصصات المقترحة
//    - اذكر أي مهارات إضافية قد تكون مفيدة للطالب لتطويرها قبل دخول الجامعة

// يرجى تقديم هذه المعلومات بشكل منظم ومنطقي، مع التأكد من أن جميع التوصيات مدعومة بالبيانات المتاحة وملائمة لسياق التعليم العالي في سلطنة عُمان.
//                 ";

//     // Make API call to OpenAI
//     $client = new Client();
//     try {
//         $response = $client->post('https://api.openai.com/v1/chat/completions', [
//             'headers' => [
//                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//                 'Content-Type' => 'application/json',
//             ],
//             'json' => [
//                 'model' => 'gpt-4-turbo',
//                 'messages' => [
//                     ['role' => 'system', 'content' => 'You are a career advisor helping 12th-grade students find suitable university majors. Analyze the provided data carefully and provide diverse, personalized recommendations.'],
//                     ['role' => 'user', 'content' => $template],
//                 ],
//                 'max_tokens' => 1000,
//                 'temperature' => 0.7, // Increased for more diverse outputs
//             ],
//         ]);
    
//         $body = json_decode((string) $response->getBody(), true);
       
//         return response()->json(['msg' => $body['choices'][0]['message']['content']], 200);
       
//     } catch (GuzzleException $e) {
//         return response()->json(['error' => $e->getMessage(), 'status' => 'error'], 500);
//     }
// }
    public function saveResult(Request $request)
    {
        try{
            Log::info('Request Data: ', $request->all());

            $result=new Result();
            $result->result=$request->results;
            $result->user_id=1;
            $result->save();
            return response()->json(array('msg'=> 'success'), 200);
        }catch(GuzzleException $e)
        {
            return response()->json(array('error'=> $e), 200);

        }
            
            
            
    }
    public function submitAnswer(Request $request)
    {

       
        $id=$request->id;
        $question=$request->question;
        $answer=$request->answer;
        $test = session()->get('test');
        if(!$test)
        {
            $test = [
                $id=> [
                    "question" => $question,
                    "answer" => $answer
                ]
            ];
           
        }
        else
        {
            $test[$id] = [
                
                    "question" => $question,
                    "answer" => $answer
               
            ];
            
            
        }
        session()->put('test', $test);
       
        return response()->json(array('msg'=> 'success'), 200);
    }
    public function removeAnswer(Request $request)
    {
        $test = session()->get('test');
        $id=$request->id;
        unset($test[$id]);
        session()->put('test', $test);
        session()->flash('success', 'Session updated successfully');

        // Return a JSON response with the updated session data
        return response()->json([
            'msg' => session()->get('test'),
            'status' => 'success',
        ], 200);
       
    }
    public function saveQuestions()
    {
        $test = session()->get('test');
        foreach ($test as $key => $value) {
            $question=new Questions;
            $question->question=$value['question'];
            $question->user_id=1;
            $question->answer=$value['answer'];
            $question->save();

        }
        session()->forget('test');
        return response()->json([
            'msg' => 'success',
            'status' => 'success',
        ], 200);
       
    }
    public function saveMarks(Request $request)
    {
        
            $marks=new Marks;
            $marks->marks=json_encode($request->mark);
            $marks->user_id=1;
            $marks->save();

       
        return response()->json([
            'msg' => 'success',
            'status' => 'success',
        ], 200);
       
    }
//     public function chatResponse(Request $request)
// {
//     $userQuestion = $request->message;
//     $filePath = storage_path('app/excelData/majors.xlsx');

//     try {
//         $spreadsheet = IOFactory::load($filePath);
//         $allSheetData = [];
    
//         foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
//             $sheetName = $worksheet->getTitle();
//             $sheetData = $worksheet->toArray(null, true, true, true);
            
//             // Remove empty rows
//             $sheetData = array_filter($sheetData, function($row) {
//                 return !empty(array_filter($row, 'strlen'));
//             });
    
//             $allSheetData[$sheetName] = $sheetData;
//         }
             
//         $output = "";
//             foreach ($allSheetData as $sheetName => $sheetData) {
//                 $output .= "Sheet: $sheetName\n";
//                 $output .= str_repeat('-', strlen("Sheet: $sheetName")) . "\n";
        
//                 // Determine the maximum width for each column
//                 $columnWidths = [];
//                 foreach ($sheetData as $row) {
//                     foreach ($row as $col => $cell) {
//                         $cellLength = mb_strlen($cell);
//                         if (!isset($columnWidths[$col]) || $cellLength > $columnWidths[$col]) {
//                             $columnWidths[$col] = $cellLength;
//                         }
//                     }
//                 }
        
//                 // Output the data with aligned columns
//                 foreach ($sheetData as $rowIndex => $row) {
//                     foreach ($row as $col => $cell) {
//                         $output .= str_pad($cell, $columnWidths[$col] + 2);
//                     }
//                     $output .= "\n";
//                 }
//                 $output .= "\n\n";
//             }
          
//         // If you want to see the full structure, you can use dd()
       
    
//     } catch (Exception $e) {
//         Log::error('Error reading Excel file: ' . $e->getMessage());
//         throw new \RuntimeException('Unable to read Excel file: ' . $e->getMessage());
//     }
//     $template = "You are an AI assistant designed to help students in Oman. Your primary goal is to provide accurate, clear, and helpful responses to their questions. Follow these guidelines:

// 1. Understand the question: Carefully analyze the student's query: '{$userQuestion}'

// 2. Source of information:
//    - If the answer can be found in the Omani Student Guide '{$output}', use that as your primary source.
//    - For topics not covered in the guide, use your general knowledge to provide an informative response.


// 3. Response structure:
//    - Begin with a brief, direct answer to the main question.
//    - Provide additional details or explanations in subsequent paragraphs if user ask you.


// 4. Tone and style:
//    - Be friendly and supportive, but maintain a professional tone.
//    - Use clear, concise language appropriate for students.
//    - Avoid jargon unless explaining a specific term.

// 5. Additional assistance:
//    - If the question is unclear, ask for clarification.
//    - Suggest related topics or further reading if appropriate.

// 6. Accuracy and sources:
//    - If citing specific Omani regulations or policies, mention that the information comes from the Omani Student Guide.
//    - For general knowledge answers, clarify that the information is based on your training up to April 2024.

// Remember to be helpful, accurate, and organized in your response.";

//     $client = new Client();
//     try {
//         $response = $client->post('https://api.openai.com/v1/chat/completions', [
//             'headers' => [
//                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//                 'Content-Type' => 'application/json',
//             ],
//             'json' => [
//                 'model' => 'gpt-4-turbo',
//                 'messages' => [
//                     ['role' => 'system', 'content' => 'You are a helpful assistant for students in Oman.'],
//                     ['role' => 'user', 'content' => $template],
//                 ],
//                 'max_tokens' => 800,
//                 'temperature' => 0.7,
//             ],
//         ]);

//         $body = json_decode((string) $response->getBody(), true);
//         $aiResponse = $body['choices'][0]['message']['content'];

//         // Process the AI response to ensure proper formatting
//         $formattedResponse = $this->formatResponse($aiResponse);

//         return response()->json(['msg' => $formattedResponse], 200);
//     } catch (GuzzleException $e) {
//         return response()->json([
//             'error' => 'An error occurred while processing your request: ' . $e->getMessage(),
//             'status' => 'error',
//         ], 500);
//     }
// }
/////////////////////////
public function chatResponse(Request $request)
{
    $userQuestion = $request->message;
   
    // if (!(session()->get('chat_history', []))) {
    //     $chat_History = 'No previous chat history.';
    // } else {
    //     $chat_History = session()->get('chat_history', []);
    // }
    // if (is_array($chat_History) && !empty($chat_History)) {
    //     // Loop through the chat history array and format the output
    //     foreach ($chat_History as $index => $qa) {
    //         $chat .= ($index + 1) . ". سؤال الطالب: " . $qa['question'] . " | إجابتك: " . $qa['answer'] . "\n";  // Add newline for readability
    //     }
    // } else {
    //     $chat = 'No previous chat history.';
    // }
    $filePath = storage_path('app/excelData/majors.xlsx');

    try {
        // Load Excel data from cache
        $excelData = $this->getExcelDataFromCache($filePath);

        // Truncate the Excel data if it's too long
        $maxExcelDataLength = 2000; // Adjust this value as needed
        $truncatedExcelData = mb_substr($excelData, 0, $maxExcelDataLength);
        if (mb_strlen($excelData) > $maxExcelDataLength) {
            $truncatedExcelData .= "... [Data truncated due to length]";
        }

        $template = "You are an AI assistant designed to help students in Oman. Your primary goal is to provide accurate, clear, and helpful responses to their questions. Follow these guidelines:

        1. Understand the question: Carefully analyze the student's query: '{$userQuestion}'
        

        2. Source of information:
            -Do not forget what the user ask previously and your answer for him.
            - Use the following Omani Student Guide data as your primary source of information:

            {$truncatedExcelData}

            - For topics not covered in the guide above, use your general knowledge to provide an informative response.
            

        3. Response structure:
            - Begin with a brief, direct answer to the main question.
            - Provide additional details or explanations in subsequent paragraphs if the user asks.

        4. Tone and style:
            - Be friendly and supportive, but maintain a professional tone.
            - Use clear, concise language appropriate for students.
            - Avoid jargon unless explaining a specific term.

        5. Additional assistance:
            - If the question is unclear, ask for clarification.
            - Suggest related topics or further reading if appropriate.

        6. Accuracy and sources:
            - If citing specific Omani regulations or policies, mention that the information comes from the Omani Student Guide provided above.
            - For general knowledge answers, clarify that the information is based on your training up to April 2024.

        Remember to be helpful, accurate, and organized in your response.";

        // Use asynchronous requests for faster API calls
        $client = new Client(['http_errors' => false]);
        $promise = $client->postAsync('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant for students in Oman.'],
                    ['role' => 'user', 'content' => $template],
                ],
                'max_tokens' => 800,
                'temperature' => 0.7,
            ],
        ]);

        $response = $promise->wait();
        $body = json_decode((string) $response->getBody(), true);

        if ($response->getStatusCode() != 200) {
            throw new \RuntimeException('API request failed: ' . ($body['error']['message'] ?? 'Unknown error'));
        }

        $aiResponse = $body['choices'][0]['message']['content'];

        // Process the AI response to ensure proper formatting
        $formattedResponse = $this->formatResponse($aiResponse);
        // Retrieve the existing chat history from the session
        // $chatHistory = session()->get('chat_history', []);

        // // Add the new question and answer to the chat history
        // $chatHistory[] = [
        //     "question" => $userQuestion,
        //     "answer" => $formattedResponse
        // ];

        // // Limit the chat history to the last 10 exchanges (or any number you prefer)
        // $chatHistory = array_slice($chatHistory, -10);

        // // Store the updated chat history back in the session
        // session()->put('chat_history', $chatHistory);
        return response()->json(['msg' => $formattedResponse], 200);
    } catch (\Exception $e) {
        Log::error('Error in chatResponse: ' . $e->getMessage());
        return response()->json([
            'error' => 'An error occurred while processing your request.',
            'status' => 'error',
        ], 500);
    }
}

private function getExcelDataFromCache($filePath)
{
    return Cache::remember('excel_data', 3600, function () use ($filePath) {
        $spreadsheet = IOFactory::load($filePath);
        $allSheetData = [];

        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $sheetName = $worksheet->getTitle();
            $sheetData = $worksheet->toArray(null, true, true, true);
            
            // Remove empty rows
            $sheetData = array_filter($sheetData, function($row) {
                return !empty(array_filter($row, 'strlen'));
            });

            $allSheetData[$sheetName] = $sheetData;
        }

        return $this->convertExcelDataToString($allSheetData);
    });
}

private function convertExcelDataToString($allSheetData)
{
    $output = "";
    foreach ($allSheetData as $sheetName => $sheetData) {
        $output .= "Sheet: $sheetName\n" . str_repeat('-', strlen("Sheet: $sheetName")) . "\n";

        $columnWidths = [];
        foreach ($sheetData as $row) {
            foreach ($row as $col => $cell) {
                $columnWidths[$col] = max($columnWidths[$col] ?? 0, mb_strlen($cell));
            }
        }

        foreach ($sheetData as $row) {
            foreach ($row as $col => $cell) {
                $output .= str_pad($cell, $columnWidths[$col] + 2);
            }
            $output .= "\n";
        }
        $output .= "\n\n";
    }
    return $output;
}

///////////////////////////
private function formatResponse($response)
{
    // Split the response into paragraphs
    $paragraphs = explode("\n\n", $response);

    // Process each paragraph
    $formattedParagraphs = array_map(function ($paragraph) {
        // Convert bullet points to HTML list items
        if (strpos($paragraph, '- ') === 0) {
            $items = explode("\n- ", $paragraph);
            $listItems = array_map('trim', $items);
            return "<ul>" . implode("", array_map(function($item) {
                return "<li>$item</li>";
            }, $listItems)) . "</ul>";
        }

        // Wrap normal paragraphs in <p> tags
        return "<p>$paragraph</p>";
    }, $paragraphs);

    // Join the formatted paragraphs
    return implode("\n", $formattedParagraphs);
}
    // public function chatResponse(Request $request)
    // {  
        
    //     $userQuestion=$request->message;
       
    //     $template="Answer the students question which is ${userQuestion}. 
    //     You can take benefit from Student Guide in Oman only if the answer can be from it otherwise use your own knowladeg.
    //     Student Guide include:
    //     You must be accurate, clear and kindful.
    //     Organize your answer so the students can read it easly.
    //     ";
    //     $client = new Client();
    //     try {
    //         $response = $client->post('https://api.openai.com/v1/chat/completions', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'model' => 'gpt-4-turbo',
    //                 'messages' => [
    //                     ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //                     ['role' => 'user', 'content' =>$template],
                        
                        
                       
    //                 ],
    //                 'max_tokens' => 500,
    //                 'temperature' => 0.7,
    //             ],
    //         ]);
        
    //         $body = json_decode((string) $response->getBody(), true);
            
    //         return response()->json(array('msg'=> $body['choices'][0]['message']['content']), 200);

    //     } catch (GuzzleException $e) {
           
    //         return response()->json([
    //             'error' =>   $e->getMessage(),
    //             'status' => 'error',
    //         ], 200);
    //     }

    // }
    public function downloadPDF()
    {
        $result=Result::where('user_id',1)->first();
        // Split the recommendations into an array
        $recommendations = explode("\n\n", trim($result->result));
        array_shift($recommendations); 
        // Initialize arrays to hold majors and reasons
    $majors = [];
    $reasons = [];
   
    // Loop through each recommendation and split into major and reason
    foreach ($recommendations as $rec) {
        if (!empty(trim($rec))) {
            // Use preg_match to ensure it matches the expected pattern
            if (preg_match('/^\d+\.\s*\*\*(.*?)\*\*\s*-\s*(.*)$/u', $rec, $matches)) {
                $cleanedRec = $matches[1] . ' - ' . $matches[2];
                
                // Explode the cleaned recommendation and check if both parts exist
                $splitRec = explode(' - ', $cleanedRec);
                if (count($splitRec) == 2) {  // Ensure there are 2 elements
                    $majors[] = trim($splitRec[0]);  // Major
                    $reasons[] = trim($splitRec[1]); // Reason
                } else {
                    dd("Recommendation does not have both a major and a reason: $cleanedRec");
                }
            } else {
                // Handle the case where the format doesn't match
                // dd("Pattern did not match: $rec");
                continue;
            }
        }
    }

    // Pass the majors and reasons to the view for PDF generation
    $pdf = PDF::loadView('pdf.result', ['majors' => $majors, 'reasons' => $reasons]);

    return $pdf->download('result.pdf');
}
    public function ordering()
    {
        $result=Result::where('user_id',1)->first();
        $questions=Questions::where('user_id',1)->get();
        $marks = Marks::where('user_id', 1)->first();
        $marksArray = json_decode($marks->marks, true);
        $skills=json_encode($questions);
        $majors=json_encode($result->result);
        $grade=json_encode($marksArray);
        $client = new Client();
       
       
        $template = "
           بناءً على المعلومات التالية عن الطالب:

    المهارات والاهتمامات والعواطف: {$skills}
    العلامات: {$grade}

    وبالنظر إلى هذه المعلومات الإضافية ذات الصلة:
    {$majors}
    قم بترتيب خيارتي في القبول الموحد و ذلك بإظهار رمز التخصص المناسب لي . اطلب منك ان تختار لي 12 خيار.

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
                                ['role' => 'system', 'content' => 'You are an expret advisor who can help 12 garde students on Oman to order their choises on Unified admission (Omani Student Guide).'],
                                ['role' => 'user', 'content' => $template],
                               
                            ],

                    'max_tokens' => 1000,
                    'temperature' => 0.5,
                ],
            ]);
        
            $body = json_decode((string) $response->getBody(), true);
            dd($body['choices'][0]['message']['content']);
            // return response()->json(array('msg'=> $body['choices'][0]['message']['content']), 200);
           
        } catch (GuzzleException $e) {
            return response()->json(array('error'=> $e,'status' => 'error'), 200);
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
