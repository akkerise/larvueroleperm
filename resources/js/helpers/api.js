import axios from 'axios'

// import Auth from '../store/auth'

export const URI_API_CMS = `/api/cms/`

export function get(url) {
    return axios({
        method: 'GET',
        url: URI_API_CMS + url,
        // headers: {
        //     'Authorization': `Bearer ${Auth.state.api_token}`
        // }
    })
}

export function post(url, data) {
    return axios({
        method: 'POST',
        url: URI_API_CMS + url,
        data: data,
        // headers: {
        //     'Authorization': `Bearer ${Auth.state.api_token}`
        // }
    })
}

export function del(url) {
    return axios({
        method: 'DELETE',
        url: URI_API_CMS + url,
        // headers: {
        //     'Authorization': `Bearer ${Auth.state.api_token}`
        // }
    })
}


