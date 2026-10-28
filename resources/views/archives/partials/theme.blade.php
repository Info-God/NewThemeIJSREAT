{{-- Gives an archive page the redesigned header, footer and theme styles
     (the same chrome as the homepage). --}}
@push('page_styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=Source+Sans+3:wght@400;600;700;800;900&display=swap">
    @vite(['resources/css/home.css', 'resources/css/archive.css'])
@endpush

@section('site_header')
    <x-homepage.header />
@endsection

@section('site_footer')
    <x-homepage.footer />
@endsection
