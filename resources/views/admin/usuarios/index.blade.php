@extends('layouts.app')

@section('content')
<pagina tamanho="12">

	@if($errors->all())
		@foreach($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  {{$value}}
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		@endforeach
	@endif

	<painel titulo="Lista de Usuários">
		<migalhas :lista="{{$listaMigalhas}}"></migalhas>
		<tabela-lista 
		v-bind:titulos="['#','Nome','E-mail']"
		v-bind:itens="{{json_encode($listaModelo)}}"
		ordem="desc" ordemcol="1"
		criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/" token="{{csrf_token()}}"
		modal="sim"
		></tabela-lista>
		<div align="center">
			{{$listaModelo}}
		</div>
	</painel>

</pagina>
<modal nome="adicionar" titulo="Adicionar">
	<formulario id="formAdicionar" css="" action="{{route('usuarios.store')}}" method="post" enctype="" token="{{csrf_token()}}">

		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="name" placeholder="Nome" value="{{old('name')}}">
		</div>
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
		</div>
		<div class="form-group">
			<label for="autor">Autor</label>
			<select class="form-control" id="autor" name="autor">
				<option {{(old('autor') && old('autor') == 'N'? 'selected': '' )}} value="N">Não</option>
				<option {{(old('autor') && old('autor') == 'S'? 'selected' :'' )}} value="S">Sim</option>
			</select>
		</div>	
		<div class="form-group">
			<label for="admin">Admin</label>
			<select class="form-control" id="admin" name="admin">
				<option {{(old('admin') && old('admin') == 'N'? 'selected': '' )}} value="N">Não</option>
				<option {{(old('admin') && old('admin') == 'S'? 'selected' :'' )}} >Sim</option>
			</select>
		</div>
		<div class="form-group">
			<label for="password">Senha</label>
			<input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
		</div>		
	</formulario>
	<span slot="botoes">
		<button form="formAdicionar" class="btn btn-info">Adicionar</button>
	</span>
</modal>

<modal nome="editar" titulo="Editar">
	<formulario id="formEditar" css="" :action="'/admin/usuarios/' + $store.state.item.id" method="put" enctype="" token="{{csrf_token()}}">
		<div class="form-group">
			<label for="titulo">Nome</label>
			<input type="text" class="form-control" id="nome" v-model="$store.state.item.name" name="name" placeholder="Nome">
		</div>
		<div class="form-group">
			<label for="descricao">E-mail</label>
			<input type="email" class="form-control" id="email" v-model="$store.state.item.email" name="email" placeholder="E-mail">
		</div>	
		<div class="form-group">
			<label for="autor">Autor</label>
			<select class="form-control" id="autor" name="autor" v-model="$store.state.item.autor">
				<option  value="N">Não</option>
				<option  value="S">Sim</option>
			</select>
		</div>
		<div class="form-group">
			<label for="admin">Admin</label>
			<select class="form-control" id="admin" name="admin" v-model="$store.state.item.admin">
				<option  value="N">Não</option>
				<option  value="S">Sim</option>
			</select>
		</div>
		<div class="form-group">
			<label for="password">Senha</label>
			<input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
		</div>	
	</formulario>
	<span slot="botoes">
		<button form="formEditar" class="btn btn-success">Salvar</button>	
	</span>	
</modal>
<modal nome="detalhe" :titulo="$store.state.item.name">
	<p>@{{$store.state.item.email}}</p>

</modal>
@endsection

