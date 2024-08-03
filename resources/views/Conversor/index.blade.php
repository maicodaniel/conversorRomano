@extends('layout.index')

@section('content')
    <div class="col ">
        <div class='row '>
            <div class="col-md-12 ">
                <div class="container">

                    <h1>index conversor</h1>

                    <div>
                        <input id="inputnumeral">
                        <BUTTON type='button' class='btn btn-success btn-cadastrar btn-criar-fatura' onclick='conversao()'>CONVERTER</BUTTON>
                    </div>

{{--                    <input id="numeroConvertido">--}}
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

    <script>

        function conversao(){
            let numero = $('#inputnumeral').val();

            console.log(numero);

            $.ajax({
                url: 'conversor/teste',
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


                       //  console.log(texto);
                       // let texto = $('#numeroConvertido').val()
                       //  $(texto).css({'text-decoration-line': 'overline'});

                    }
                },
                error: (data, textStatus, errorThrow) => {
                    console.log(data)
                    alert('Erro ao calcular faturamentos');
                }
            })
        }
    </script>
@endsection
