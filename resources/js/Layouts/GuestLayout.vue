<script setup>
import { Link } from '@inertiajs/vue3';


</script>
<template>
  <div class="navbar">
    <div class="container mx-auto">
      <div class="flex-1">
        <Link class = "normal-case text-xl" href="/register">LERIA</Link>
      </div>
      <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
          <li>
            <Link href="/register">Registrate</Link>
          </li>
          <li>
            <Link href="/login">Entrar</Link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>