@empty($filial)
<form action="{{ route('filial.store') }}" method="post">
@else
<form  action="{{ route('filial.update',['filial' => $filial->id]) }}" method="post">
@method('put')    
@endempty

    @csrf
    <div class="row">
        <div class="col-md-1">
            <label for="">Cod.</label>
            <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{old('codigo')? old('codigo') : !empty($filial->codigo) ? $filial->codigo :''}}">
            @error('codigo')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="">Filial</label>
            <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{old('nome')? old('nome') : !empty($filial->nome) ? $filial->nome :''}}">
            @error('nome')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
</form>