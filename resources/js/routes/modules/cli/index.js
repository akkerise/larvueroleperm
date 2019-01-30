import Error404 from '../../../views/Errors/404'
import Home from  '../../../views/Cli/Index/Home'
export default [
    {
        path: '/',
        component: Home,
        hidden: true,
        name: 'cli'
    },
    {
        path: '*',
        component: Error404,
        meta: {title: 'error404'}
    }
]
