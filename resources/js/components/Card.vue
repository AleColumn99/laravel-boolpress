<template>
  <div class="card mb-3" >

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{ title }}</h5>
                        <span class="badge badge-success custom-badge">{{ category }}</span>
                    </div>
                    <i>{{ date }}</i>
                    <p class="card-text">{{ truncateText }}</p>

                    <router-link class="btn btn-primary" :to="{name: 'detail', params:{slug}}">Vedi post</router-link>
                </div>

    </div>

</template>

<script>
export default {
    name: 'Card',
    props:['title','content','date','category','slug'],
    data(){
        return{
            maxTextLength:150
        }
    },
    computed:{
        truncateText(){
            let text = this.content;
            if(text.length > this.maxTextLength){
                return text.substr(0,this.maxTextLength) + '...';
            }
            return text;
        }
    }
}
</script>

<style lang="scss">
    .custom-badge{
        display: inline-block;
        height: 2rem;
        line-height: 2rem;
    }
</style>
