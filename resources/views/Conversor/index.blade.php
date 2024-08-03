@extends('layout.index')

@section('content')
    <div class="col ">
        <div class='row '>
            <div class="col-md-12 ">
                <div class="container">

                    <h1>Numeros Arabicos para Romanos</h1>

                    <div class="mt-5">
                        <input id="inputnumeral">
                        <BUTTON type='button' class='btn btn-success btn-cadastrar btn-criar-fatura' onclick='conversao()'>CONVERTER</BUTTON>
                    </div>

                    <span style="display:flex;">
                      <span id="numeroConvertido" ></span>
                      <span id="numeroConvertido2" ></span>
                    </span>
                </div>
                <hr>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="col ">
        <div class='row '>
            <div class="col-md-12 ">
                <div class="container">

                    <h1>Numeros Romanos para Arabicos</h1>


                    <span>M= 1000  D= 500  C= 100  L= 50  X= 10  V= 5  I= 1</span>
                    <div>
                        <span>Obs: Apenas 3 letras iguais podem ser colocadas em sequencia!</span>
                    </div>

                    <div>
                        <span>Obs2: O campo a esquerda utiliza a notação de multiplicação, todos os digitos serao multiplicados por 1000</span>
                    </div>

                    <div class="mt-5">
                        <input id="inputnumeralRomano"  style="text-transform:uppercase; text-decoration-line: overline" oninput='validarRomano()' type="text">
                        <input id="inputnumeralRomano2"  style="text-transform:uppercase" oninput='validarRomano()' type="text">
                        <BUTTON type='button' class='btn btn-success btn-cadastrar btn-criar-fatura' onclick='conversaoRomano()'>CONVERTER</BUTTON>
                    </div>

                    {{--                    <input id="numeroConvertido">--}}
                    <span style="display:flex;">
                      <span id="numeroConvertidoRomano" ></span>
                    </span>
                </div>
                <hr>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <script>

        function conversao(){
            let numero = $('#inputnumeral').val();

            console.log(numero);

            $.ajax({
                url: 'conversor/arabicos',
                type: 'POST',
                data:{
                    numero: numero,
                    _token: "{{ csrf_token() }}",

                },
                dataType: 'JSON',
                success: (data) => {
                    if (data.status == true) {

                        $('#numeroConvertido').text('');
                        $('#numeroConvertido2').text('');
                        console.log(data)
                        let str =  data.romano;

                        var milhar = str.split("+");
                        if(milhar.length > 1 ){
                            console.log(milhar.length)

                            $('#numeroConvertido').text(milhar[0]).css({'text-decoration-line': 'overline','font-weight': 'bold'});
                            $('#numeroConvertido2').text(milhar[1]).css({'font-weight': 'bold'});
                        }else{
                            $('#numeroConvertido2').text(milhar[0]).css({'font-weight': 'bold'});
                        }
                        console.log(milhar)

                    }
                },
                error: (data, textStatus, errorThrow) => {
                    console.log(data)
                    alert('Erro ao calcular faturamentos');
                }
            })
        }


        function conversaoRomano(){
            let milhar = $('#inputnumeralRomano').val();
            let numero = $('#inputnumeralRomano2').val();


            $.ajax({
                url: 'conversor/romano',
                type: 'POST',
                data:{
                    milhar: milhar,
                    numero: numero,
                    _token: "{{ csrf_token() }}",

                },
                dataType: 'JSON',
                success: (data) => {

                    console.log(data)
                    if (data.status == true) {

                        $('#numeroConvertidoRomano').text('');
                        $('#numeroConvertido2').text('');

                        let str =  data.romano;


                        $('#numeroConvertidoRomano').text(data.total).css({'font-weight': 'bold'});
                        // $('#numeroConvertido2').text(milhar[1]).css({'font-weight': 'bold'});

                    }
                },
                error: (data, textStatus, errorThrow) => {
                    console.log(data)
                    alert('Erro ao calcular faturamentos');
                }
            })
        }

        function validarRomano(){

            var arr = ['M','D','C','L','X','V','I'];

            let numero = $('#inputnumeralRomano').val().toUpperCase();
            let numero2 = $('#inputnumeralRomano2').val().toUpperCase();
            let carac = numero.slice(-1);
            let carac2 = numero2.slice(-1);

            if (numero = ''){
                $('#inputnumeralRomano').val('');
            }

            console.log(arr.includes(carac));
            if(arr.includes(carac) == false) {
                $('#inputnumeralRomano').val(numero.slice(0, -1) + '');
            }

            if(arr.includes(carac2) == false) {
                $('#inputnumeralRomano2').val(numero2.slice(0, -1) + '');
            }

            let regex = /([mli])\1{3}/gi;
            let result = numero.match(regex);
            let result2 = numero2.match(regex);

            console.log(numero);
            console.log(result);
            if (result !== null){
                $('#inputnumeralRomano').val(numero.slice(0, -1) + '');
            }

            if (result2 !== null){
                $('#inputnumeralRomano2').val(numero2.slice(0, -1) + '');
            }
        }

    </script>
@endsection
