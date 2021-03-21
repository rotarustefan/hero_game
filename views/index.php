<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
    </head>
    <body> 
        <div class="container">
            <div class="row" style="height: 100vh;">
                <div class="col-12 text-center align-self-center">
                    <button class="btn-success btn btn-lg" id="start">Start New Game</button>
                    <div id="log-container" class="text-left mx-auto mt-5" style="display: none; width: fit-content;">
                        <ul>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            document.getElementById('start').addEventListener('click', function(){
                fetch('/game-log')
                .then(response => response.json())
                .then(function (data) {
                    var html = '';
                    data.forEach(function(el){
                        html+='<li>' + el + '</li>'
                    })
                    document.getElementById('log-container').innerHTML = html;
                    document.getElementById('log-container').style.display = '';
                }).catch(function (err) {
                    console.warn('Something went wrong.', err);
                });
            })
        </script>
    </body>
</html>