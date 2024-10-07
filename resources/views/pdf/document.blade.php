<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF Table Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      

        #content {
            padding: 20px;
            margin: 20px auto; 
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px; 
        }

        #print-btn {
            padding: 10px 20px;
            background-color: #3498db; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; 
        }

        #print-btn:hover {
            background-color: #00c7cd; 
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e9ecef;
        }

        @media print {
            body * {
                visibility: hidden; 
            }

            #content,
            #content * {
                visibility: visible; 
            }

            #content {
                position: absolute; 
                left: 0;
                top: 0;
            }

            table {
                page-break-inside: auto; 
            }
        }
    </style>
</head>

<body>
    <div id="content" class="container">
        <h1 class="text-center" style="color: #333;">مقترح الخيارات الجامعية</h1>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>رمز التخصص</th>
                            <th>المؤسسة العلمية</th>
                            <th>التخصص الجامعي</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>جامعة مسقط</td>
                            <td>هندسة البرمجيات</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button id="print-btn" class="btn btn-primary">Print PDF</button>
    </div>

    <script>
        document.getElementById('print-btn').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>
