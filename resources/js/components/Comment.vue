<template>
      <li class="comment-wrapper animate slideInLeft ">
        <div class="profile">
          <img :src="avatar" alt=""></div>
        <div class="msg has-shadow">
          <div class="msg-body"><p class="name">{{comment.user.pseudo}} <span class="date">{{posted_at}}</span></p>
            <p class="content">{{comment.content}}</p></div>
        </div>
      </li>
</template>

    <script>
      export default {

        name: "Comment",
        props: ['comment'],
        computed: {
          posted_at() {
            return moment(this.comment.created_at).format('MMMM Do YYYY')
          },
          avatar() {
            return `https://api.adorable.io/avatars/48/${this.comment.author}@adorable.io.png`
          }
        }
      }
    </script>

