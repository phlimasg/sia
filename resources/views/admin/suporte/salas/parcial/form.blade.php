@empty($sala)
<form action="{{ route('salas.store',['filial' => $filial->id]) }}" method="post">
@else
<form  action="{{ route('salas.update',['filial' => $filial->id, 'salas' => $sala->id]) }}" method="post">
@method('put')    
@endempty
    @csrf
    <input type="hidden" name="filial_id" value="{{$filial->id}}">
    <div class="row">
        <div class="col-md-1">
            <label for="">Num.</label>
            <input type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{old('numero')? old('numero') : !empty($filial->numero) ? $filial->numero :''}}">
            @error('numero')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="">Descrição</label>
            <input type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{old('descricao')? old('descricao') : !empty($filial->descricao) ? $filial->descricao :''}}">
            @error('descricao')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
</form>