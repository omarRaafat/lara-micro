<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .upload-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%
        }
        .upload-container input[type="file"] {
            margin: 20px 0;
        }
        .upload-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .upload-container button:hover {
            background-color: #0056b3;
        }
    </style>
     <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
     <script src="{{asset('js/CacheStorage.js')}}"> </script>
</head>
<body>

    <div class="upload-container">
        <h1>Upload Govermental Files (national id  - driving liscence )</h1>
        <form action="{{route('media.store')}}" method="post" enctype="multipart/form-data" id="filepond-form">
            @csrf
            <input type="file" name="files[]" multiple id="" >
            <br>
            <button onclick="submit()" type="button" style="background-color: green">Submit</button>
         
        </form>
    </div>

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>

        const filesInput = document.querySelector('input[type="file"]');
        const token  = '{{csrf_token()}}';
        const cacheStorage = new CacheStorage('tmp');
        let tmpFiles = cacheStorage.get();
        const formElement = document.getElementById('filepond-form')
        const forceClearCache = "{{session()->pull('forceClearCache')}}"

        if(forceClearCache){
            cacheStorage.clear()
            tmpFiles = []
        }

        FilePond.setOptions({
                server: {

                    process: {
                        url: '{{url('/process')}}',
                        onload: (path) => cache(path)
                    } ,
                    revert: '{{url('/revert')}}' ,
                    restore: '{{url('/restore?path=')}}' ,
                    headers: {
                        'X-CSRF-TOKEN': token
                        }
                    

                }

            
        });

        const pond  = FilePond.create(filesInput , {
            allowMultiple:true,
            files: tmpFiles 
        })
        const cache = (path) => {
            tmpFiles.unshift({
                source: path,
                options: {
                    type: 'limbo',
                }
            })

            cacheStorage.set(tmpFiles)
            return path;
        }

        document.addEventListener('FilePond:processfilerevert' , (response) => {
            const serverId = response.detail.file.serverId
            tmpFiles = tmpFiles.filter(tmpFile=> tmpFile.source !== serverId)
            cacheStorage.set(tmpFiles)
        })

        function submit(){
            formElement.submit();
        }

    </script>

</body>
</html>
