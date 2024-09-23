@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                   <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height: 45vh">


                                    </ul>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" id="message" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" id="send" class="btn btn-primary w-100">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <p><strong>User Online</strong></p>
                            <ul
                                id="users"
                                class="list-unstyled overflow-auto text-info"
                                style="min-height: 45vh"
                            >

                            </ul>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        const usersElement=document.getElementById('users')
        const messageElement=document.getElementById('messages')

        Echo.join('chat')
            .here((users) => {

                users.forEach((user,index) => {
                    const element=document.createElement('li')
                    element.setAttribute('id', user.id)
                    element.innerText = user.name
                    usersElement.appendChild(element)
                })
            })
            .joining((user) => {
                const element=document.createElement('li')
                element.setAttribute('id', user.id)
                element.innerText = user.name
                usersElement.appendChild(element)
            })
            .leaving((user) => {
                const element=document.getElementById(user.id)
                element.parentNode.removeChild(element)
            })
            .listen('MessageSent', (e) => {
                const element = document.createElement('li')
                element.innerText = e.user.name +': '+ e.message
                messageElement.appendChild(element)
            })
    </script>
    <script type="module">
        const messageElement=document.getElementById('message')
        const sendElement=document.getElementById('send')

        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            window.axios.post('/chat/message', {
                message: messageElement.value
            })

            messageElement.value= ""
        })

    </script>
@endpush
