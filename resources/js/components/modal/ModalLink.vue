<template>
	<div :class="cssdiv">
		<span v-if="item">
			<button v-on:click="preencheFormulario(item)" v-if="tipo == 'button'" type="button" :class="css || 'btn btn-primary btn-block'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
			<button v-on:click="preencheFormulario(item)" v-if="!tipo || (tipo != 'button' && tipo != 'link') " type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
			<a v-if="tipo == 'link'" href="#" :class="css || ''" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</a>			
		</span>

		<span v-if="!item">
			<button v-if="tipo == 'button'" type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
			<button v-if="!tipo || (tipo != 'button' && tipo != 'link') " type="button" :class="css || 'btn btn-primary'" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</button>
			<a v-if="tipo == 'link'" href="#" :class="css || ''" data-toggle="modal" :data-target="'#'+nome">{{titulo}}</a>			
		</span>

	</div>	
</template>

<script>
export default{
	props:['tipo','nome','titulo','css','cssdiv','item','url'],
	methods: {
		preencheFormulario: function(){
			axios.get(this.url + this.item.id).then(res => {
				this.$store.commit('setItem',res.data);
			});
			// this.$store.commit('setItem',this.item);
		}
	}
};
</script>