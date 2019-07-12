import BlogArticle from '@/components/Pages/BlogArticle.vue'
import BlogEditArticle from '@/components/Pages/BlogEditArticle.vue'
import BlogEditUser from '@/components/Pages/BlogEditUser.vue'
import BlogList from '@/components/Pages/BlogList.vue'
import BlogLogin from '@/components/Pages/BlogLogin.vue'
import BlogNewArticle from '@/components/Pages/BlogNewArticle.vue'
import BlogNewUser from '@/components/Pages/BlogNewUser.vue'
import BlogPanel from '@/components/Pages/BlogPanel.vue'
import BlogUsers from '@/components/Pages/BlogUsers.vue'

const routes = [
  { path: '/', component: BlogList, name: 'BlogList' },
  { path: '/BlogArticle', component: BlogArticle, name: 'BlogArticle' },
  { path: '/BlogEditArticle', component: BlogEditArticle, name: 'BlogEditArticle' },
  { path: '/BlogEditUser', component: BlogEditUser, name: 'BlogEditUser' },
  { path: '/BlogLogin', component: BlogLogin, name: 'BlogLogin' },
  { path: '/BlogNewArticle', component: BlogNewArticle, name: 'BlogNewArticle' },
  { path: '/BlogNewUser', component: BlogNewUser, name: 'BlogNewUser' },
  { path: '/BlogPanel', component: BlogPanel, name: 'BlogPanel' },
  { path: '/BlogUsers', component: BlogUsers, name: 'BlogUsers' }
  // { path: '*', component: BlogList }
]

export default routes
