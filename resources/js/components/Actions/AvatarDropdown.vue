<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const user = computed(() => page.props.auth.user)

</script>

<template>
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img :src="'/storage/'+ user.profile_pic" />
        </div>
      </label>
      <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
        <li>
          <Link :href="'/user/'+ user.user_name">Perfil</Link>
        </li>
        <li><a>Settings</a></li>
        <li><Link method="post" href="/logout">Cerrar sesión</Link></li>
      </ul>
    </div>
</template>