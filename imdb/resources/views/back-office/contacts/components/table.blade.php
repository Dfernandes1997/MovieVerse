<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Messages</h4>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Read</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Title</th>
                        <th scope="col">Message</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contact as $item)
                    <tr>
                        <td update="readStatus_{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#ContactsModal" class="modal-trigger" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-contacto="{{ $item->contacto }}" data-titulo="{{ $item->titulo }}" data-mensagem="{{ $item->mensagem }}" data-read="{{ $item->read }}">
                            @if($item->read == 0)
                                <i class="fa fa-envelope fa-2x"></i>
                            @else
                                <i class="fa fa-envelope-open fa-2x"></i>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contacto }}</td>
                        <td>{{ $item->titulo }}</td>
                        <td>{{ $item->mensagem}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <div class="bg-secondary rounded h-100 p-4">
                    <ul class="pagination">
                        <!-- Link para a página anterior -->
                        @if ($contact->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $contact->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif
                
                        <!-- Links das páginas -->
                        @for ($i = 1; $i <= $contact->lastPage(); $i++)
                            <li class="page-item {{ $i === $contact->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $contact->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                
                        <!-- Link para a próxima página -->
                        @if ($contact->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $contact->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Modal Informativo -->
<div class="modal fade" id="ContactsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ContactsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="ContactsModalLabel">Message Nº: <span id="modalid"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong class="text-white">Name : </strong><span id="modalName"></span></p>
                <p><strong class="text-white">Contact : </strong><span id="modalContacto"></span></p>
                <p><strong class="text-white">Title : </strong><span id="modalTitulo"></span></p>
                <p><strong class="text-white">Message : </strong><span id="modalMensagem"></span></p>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('ContactsModal'));

    document.querySelectorAll('.modal-trigger').forEach(function (item) {
        item.addEventListener('click', function (event) {
            var id = this.getAttribute('data-id');
            var read = this.getAttribute('data-read');
            var name = this.getAttribute('data-name');
            var contacto = this.getAttribute('data-contacto');
            var titulo = this.getAttribute('data-titulo');
            var mensagem = this.getAttribute('data-mensagem');

            console.log('ID:', id);
            console.log('Read:', read);
            console.log('Name:', name);
            console.log('Contacto:', contacto);
            console.log('Titulo:', titulo);
            console.log('Mensagem:', mensagem);

            // Verifica se o status de leitura é 0 (não lido)
            if (read == 0) {
                // Envia uma solicitação AJAX para atualizar o campo 'read' para 1 no servidor
                $.ajax({
                    type: 'POST',
                    url: '{{ route("update.read") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { messageId: id },
                    success: function(response) {
                        console.log('Status de leitura atualizado com sucesso:', response);
                        document.querySelector('[update="readStatus_' + id + '"]').innerHTML = '<i class="fa fa-envelope-open fa-2x"></i>';
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao atualizar o status de leitura:', error);
                    }
                });
            }

            // Atualiza o conteúdo do modal com os detalhes da mensagem
            document.getElementById('modalid').innerText = id;
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalContacto').innerText = contacto;
            document.getElementById('modalTitulo').innerText = titulo;
            document.getElementById('modalMensagem').innerText = mensagem;

            // Exibe o modal
            myModal.show();
        });
    });
});
</script>