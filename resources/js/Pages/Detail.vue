<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps({
    book: {
        type: Object,
        default: () => ({}),
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

});
const loadFallbackImage = (event) => {
    event.target.src = "https://play-lh.googleusercontent.com/_tslXR7zUXgzpiZI9t70ywHqWAxwMi8LLSfx8Ab4Mq4NUTHMjFNxVMwTM1G0Q-XNU80";
}
</script>

<template>
    <Head title="Product Detail" />
    <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <!-- <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search"> -->
        </form>

        <div class="text-end">
            <div v-if="canLogin" class=" text-right mb-3">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="fbtn btn-outline-light me-2">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="btn btn-warning">
                Register</Link>
            </template>
        </div>
          <!-- <button type="button" class="btn btn-outline-light me-2">Login</button>
          <button type="button" class="btn btn-warning">Sign-up</button> -->
        </div>
      </div>
    </div>
  </header>
    <div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" :src="book.image" @error="loadFallbackImage" width="250" /> </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">

                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">{{ book.author }}</span>
                                <h5 class="text-uppercase">{{ book.title }}</h5>

                            </div>
                            <p class="about" v-html="book.description"></p>
                            <div class="sizes mt-2">
                                <h6 class="text-uppercase">Publisher:</h6>
                                <span>{{ book.publisher}}</span>
                            </div>
                            <div class="sizes mt-2">
                                <h6 class="text-uppercase">Published:</h6>
                                <span>{{ book.published }}</span>
                            </div>
                            <div class="sizes mt-2">
                                <h6 class="text-uppercase">Genre:</h6>
                                <span>{{ book.genre}}</span>
                            </div>
                            <div class="sizes mt-2">
                                <h6 class="text-uppercase">Isbn:</h6>
                                <span>{{ book.isbn}}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
