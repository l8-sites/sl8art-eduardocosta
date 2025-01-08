
export const send = async (path, params = "", method = "GET" ) => {
    const response = await fetch('/artists_api', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            method: method,
            path: path,
            data: params,
            _token:  document.querySelector("meta[name='csrf-token']").getAttribute('content')
        })
    });
    if (response.ok) {
        const data = await response.json()
        return data
    }
    return false
}

export const spotify = async (path, params = "") => {
    const response = await fetch('/spotify', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            path: path,
            data: params,
            _token:  document.querySelector("meta[name='csrf-token']").getAttribute('content')
        })
    });
    if (response.ok) {
        const data = await response.json()
        return data
    }
    return false
}

export const youtube = async (path, params = "") => {
    const response = await fetch('/youtube', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            path: path,
            data: params,
            _token:  document.querySelector("meta[name='csrf-token']").getAttribute('content')
        })
    });
    if (response.ok) {
        const data = await response.json()
        return data
    }
    return false
}

export const socialClick = (link, click) => {
    send('click', {click: click}, 'POST')
    window.open(link, '_target')
}
