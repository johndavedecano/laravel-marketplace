import AccountSidebar from './components/AccountSidebar.vue'
import Page from './components/Page.vue'
import SelectLocation from './components/form/SelectLocation.vue'
import SelectCategory from './components/form/SelectCategory.vue'
import SelectStatus from './components/form/SelectStatus.vue'

export default function (vue) {
  vue.component('page', Page)
  vue.component('account-sidebar', AccountSidebar)
  vue.component('select-location', SelectLocation)
  vue.component('select-category', SelectCategory)
  vue.component('select-status', SelectStatus)
}
