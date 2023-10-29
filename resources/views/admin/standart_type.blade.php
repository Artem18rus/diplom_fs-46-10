@foreach ($standart_type as $key => $value) {
  {{ $value->pick_chair }}
}
@endforeach