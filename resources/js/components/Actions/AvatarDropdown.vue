<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    avatar : String
})

</script>

<template>
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img :src="'/storage/'+ avatar" />
        </div>
      </label>
      <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
        <li>
          <Link href="/profile">Perfil</Link>
        </li>
        <li><a>Settings</a></li>
        <li><Link method="post" href="/logout">Cerrar sesión</Link></li>
      </ul>
    </div>
</template>