<template>

  <div>

    <h1>
      Il mio blog
    </h1>

    <div
    v-for="post in posts"
    :key="'p'+post.id"
    class="card mb-3" >

      <div class="card-body">
          <div class="d-flex justify-content-between">
              <h5 class="card-title">{{ post.title }}</h5>
              <span class="badge badge-success custom-badge">{{ post.category }}</span>
          </div>
          <i>{{ formatDate(post.date) }}</i>
          <p class="card-text">{{ post.content }}</p>
          <a href="#" class="btn btn-primary">Vai</a>
      </div>

      <div>
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li
            :class="{'disabled': pagination.current === 1}"
            class="page-item">
                <button
                @click="getPosts(pagination.current - 1)"
                class="page-link" >&laquo;</button>
            </li>

            <li
            v-for="i in pagination.last"
            :key="'i'+i"
            :class="{'active' : pagination.current === i}"
            class="page-item">
                <button
                @click="getPosts(i)"
                  class="page-link">{{ i }}</button></li>


            <li
            :class="{'disabled': pagination.current === pagination.last}"
            class="page-item">
                <button
                @click="getPosts(pagination.current + 1)"
                class="page-link" >&raquo;</button>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  </div>

</template>

<script>

import axios from 'axios';

export default {

  name: 'Blog',

  data(){
    return{
        posts: [],
        pagination: {},
        loaded: false
    }
  },

  methods: {

    getPosts(page = 1){

      this.loaded = false;

      axios.get('http://127.0.0.1:8000/api/posts',{
          params:{
              page: page
          }
      })
        .then(res => {
            console.log(res.data.data);
            this.posts = res.data.data;
            this.pagination = {
                current: res.data.current_page,
                last: res.data.last_page
            }
            this.loaded = true;
        })
        .catch(err => {
            console.log(err);
        })

    },

    formatDate(date){
      let d = new Date(date);
      let dy = d.getDate();
      let m = d.getMonth() + 1;
      let y = d.getFullYear();

      if(dy < 10) dy = '0' + dy;
      if(m < 10) m = '0' + m;

      return `${dy}/${m}/${y}`;
    }

  },

  created() {

    this.getPosts();

  }

}
</script>

<style>

</style>