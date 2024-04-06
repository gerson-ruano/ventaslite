@extends('layouts.theme.app')


@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-color">
                <div class="card-header text-center">{{ __($appName) }}</div>
                <div id="cardBody" class="card-body text-center" style="display: none;">
                    <h5 class="text-white">Hola {{ Auth::user()->name }} {{ __('bienvenido a') }} {{$empresa->name}}</h5>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Aquí puedes colocar información relacionada con el tema o la presentación general -->
            <div class="card bg-red">
                <div class="card-body">
                    <h2 class="text-center">{{$appName}}</h2>
                    <p>Es tu destino definitivo para encontrar una amplia gama de productos de alta calidad y las
                        últimas tendencias del mercado.
                        Nuestro sitio web ofrece una experiencia de compra conveniente y placentera para aquellos que
                        buscan artículos de primera calidad.</p>
                    <!-- Puedes agregar más contenido aquí -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Esta sección puede estar destinada a productos o detalles de ventas -->
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Tecnologia</h2>
                    <p>No solo ofrece productos de alta calidad, sino también grandes ofertas y promociones especiales.
                        Mantente al tanto de nuestras ofertas
                        exclusivas y descuentos irresistibles para obtener los mejores precios en tus compras.</p>
                    <!-- Aquí puedes mostrar una lista de productos o detalles de ventas -->
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Aquí puedes colocar información relacionada con el tema o la presentación general -->
            <div class="card bg-red">
                <div class="card-body">
                    <h2 class="text-center">Experiencia de Compra</h2>
                    <p>Con una interfaz intuitiva y fácil de usar, nuestra plataforma permite a los usuarios navegar y
                        explorar diferentes categorías de
                        productos con facilidad. La búsqueda avanzada y las opciones de filtrado facilitan encontrar
                        exactamente lo que necesitas.</p>
                    <!-- Puedes agregar más contenido aquí -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Esta sección puede estar destinada a productos o detalles de ventas -->
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Atención al cliente</h2>
                    <p>Nuestro equipo de atención al cliente está dedicado a brindar asistencia y soporte excepcionales
                        a nuestros clientes. Estamos aquí
                        para resolver cualquier consulta, proporcionar información adicional y garantizar una
                        experiencia de compra satisfactoria.</p>
                    <!-- Aquí puedes mostrar una lista de productos o detalles de ventas -->
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Aquí puedes colocar información relacionada con el tema o la presentación general -->
            <div class="card bg-red text-center">
                <div class="card-body">
                    <h2 class="text-center">EMPRESA</h2>
                    <h6>{{ $empresa->name }}</h6>
                    <h6>{{ $empresa->address }}</h6>
                    <h6>{{ $empresa->phone }}</h6>
                    <h6>{{ $empresa->taxpayer_id }}</h6>
                    <!-- Puedes agregar más contenido aquí -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Esta sección puede estar destinada a productos o detalles de ventas -->
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">VACIO</h2>
                    <p></p>
                    <!-- Aquí puedes mostrar una lista de productos o detalles de ventas -->
                </div>
            </div>
        </div>
    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var cardBody = document.getElementById('cardBody');

    // Muestra el card-body
    cardBody.style.display = 'block';

    // Oculta el card-body después de 5 segundos (5000 milisegundos)
    setTimeout(function() {
        cardBody.style.display = 'none';
    }, 6000);
});
</script>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Oculta el mensaje después de 3 segundos (3000 milisegundos)
    const message = document.getElementById('message');
    if (message) {
        setTimeout(() => {
            message.style.display = 'none';
        }, 3000);
    }

});
</script>
@endpush