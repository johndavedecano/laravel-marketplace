<template>
  <div class="col-lg-3 mb-4">
    <div class="list-group">
      <router-link role="menuitem" class="list-group-item" to="/account" exact>Dashboard</router-link>
      <router-link role="menuitem" class="list-group-item" to="/account/posts" exact>Manage Posts</router-link>
      <router-link role="menuitem" class="list-group-item" to="/account/messages" exact>Messages</router-link>
      <router-link role="menuitem" class="list-group-item" to="/account/notifications" exact>Notifications</router-link>
      <router-link role="menuitem" class="list-group-item" to="/account/profile" exact>Account</router-link>
      <router-link role="menuitem" class="list-group-item" to="/account/settings" exact>Settings</router-link>
    </div>
  </div>
</template>
