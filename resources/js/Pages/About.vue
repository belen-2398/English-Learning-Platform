
<template>
  <div>

    <Head title="About" />
    <div class="short-line">
      <h1 class="pt-6 font-bold">About us</h1>
      <h2 class="mx-2 text-sm md:text-lg pb-4 uppercase">Information and links</h2>
    </div>

    <div class="mx-10 md:mx-48 my-8 text-justify indent-8 text-lg">
      <p class="mb-2">
        Welcome to our language learning platform! At Babel's Tower, we are passionate about helping you embark on a
        journey
        of linguistic exploration and cultural discovery. Our mission is to make learning a new language an engaging and
        enriching experience for learners of all ages and backgrounds.
      </p>
      <p class="mb-2">
        With a team of dedicated language experts and educators, we have crafted a diverse range of language courses
        designed to cater to your individual needs and goals. Whether you're a beginner eager to get started or an
        advanced
        learner aiming for fluency, our interactive lessons, cultural insights, and immersive activities will empower you
        to
        confidently communicate in your target language.
      </p>
      <p class="mb-2">
        What sets us apart is our commitment to fostering a global community of language enthusiasts. We believe that
        language is the key to unlocking new opportunities, forging connections, and embracing diversity. Join us on this
        exciting journey, and together, let's open doors to a world of languages and cultures.
      </p>
      <p>
        Explore our courses, meet our passionate instructors, and take the first step toward becoming a more confident
        and culturally aware global citizen. Thank you for choosing us as your partner in language learning.
        We can't wait to be a part of your language-learning adventure!
      </p>
    </div>


    <div class="justify-center w-2/5 mx-auto mt-10 py-10">
      <h4 class="mx-auto border-b-2 pb-2 w-1/2 text-2xl font-semibold text-accentColor">Follow us</h4>
      <ul class="flex gap-10 justify-center my-6 text-darkColor text-center">
        <li class="my-2 hover-underline"><a href="#">Facebook</a></li>
        <li class="my-2 hover-underline"><a href="#">Instagram</a></li>
        <li class="my-2 hover-underline"><a href="#">Youtube</a></li>
        <li class="my-2 hover-underline"><a href="#">Reddit</a></li>
        <!-- TODO: add links -->
      </ul>
    </div>






  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

export default {
  name: 'About',
  components: {
    Head,
    Link
  },
  layout: FrontendLayout,
  props: { time: String }
}
</script>