<!DOCTYPE html>
<html>
<head>
    <title>AI Quiz Builder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .question {
            margin-bottom: 20px;
        }
        .option {
            margin-left: 15px;
        }
        .correct { color: green; font-weight: bold; }
        .wrong { color: red; font-weight: bold; }
        button {
            background: #4f46e5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #4338ca;
        }
        .form-row {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .form-row input[type="text"] {
            flex: 1;
            padding: 12px 14px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-row input[type="text"]:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }

        .form-row button {
            padding: 12px 20px;
            font-size: 16px;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
        }

        .form-row button:hover {
            background: #4338ca;
        }

        .question-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .question-title {
            font-weight: bold;
            margin-bottom: 12px;
        }

        .option {
            display: flex;
            align-items: center;
            padding: 8px 10px;
            margin-bottom: 6px;
            border-radius: 6px;
            cursor: pointer;
        }

        .option:hover {
            background: #eef2ff;
        }

        .option input {
            margin-right: 10px;
        }

        .submit-wrap {
            text-align: center;
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>