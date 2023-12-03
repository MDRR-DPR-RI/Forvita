<div>
    <div class="modal d-block" tabindex="-1" aria-hidden="true">
        <form wire:submit="executeQuery">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <!-- modal-content -->
                <div class="modal-content">
                    <!-- modal-header -->
                    <div class="modal-header">
                        <h5 class="modal-title">SQL Query</h5>
                        <button type="button" class="btn-close" wire:click="$dispatch('closeModal')" aria-label="Close"></button>
                    </div>
                    <!-- modal-body -->
                    <div class="modal-body container ">
                        <div class="form-group">
                            <label for="schedulerQuery">Jalankan Query pada database MYSQL server forvita</label>
                            <textarea id="schedulerQuery" wire:model="query" rows="20" cols="50" class="form-control" required></textarea>
                        </div>
                        @if(isset($success) and $success)
                            {{$success}}
                        @endif

                        @if(isset($error) and $error)
                            {{$error}}
                        @endif

                        @if(isset($results) and $results)
                        <table class="table">
                            Results
                            <thead>
                            <tr>
                            @foreach($results[0] as $key => $value)
                                <td>
                                    {{$key}}
                                </td>
                            @endforeach
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $row)
                                    <tr>
                                        @foreach($row as $value)
                                            <td nowrap="nowrap">{{$value}}</td>
                                        @endforeach
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                    </div>
                    <!-- modal-footer -->
                    <div class="modal-footer">
                        <button type="button" wire:click="$dispatch('closeModal')" class="btn btn-secondary">Tutup</button>
                        <button type="submit" class="btn btn-primary">Jalankan Query</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>