{{-- {{dd($url)}} --}}
<script>
    let url = "{{$url}}";
    console.log(url);
    url2 = url.replace(/&amp;/g, '&');
    console.log(url2);
    window.location.replace(url2);
</script>
