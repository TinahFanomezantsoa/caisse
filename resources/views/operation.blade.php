
@extends('layouts.app')

<link rel="stylesheet" href="/css/operation.css">

@section('content')
    
        <form action="" method="POST" class="container">
            @csrf
            <div class="mb-4">
                <h4> Entrée de fond de caisse </h4>
                <hr style="border : 1px solid #ffb100;" />
                
                <div class="content">
                    <div class="mb-2">
                        <div class="form">
                            <input type="hidden" name="operation_id" value="{{$operation->id}}"/>
                            <label> Type d'opération : </label>
                            <select name="operation_type_id" class="form-select" required>
                                @foreach ($operationTypes as $operationType)
                                    <option value="{{ $operationType->id }}" 
                                        @if ($operationType->id == $operation->operation_type_id))
                                            selected="selected"
                                        @endif
                                        >
                                        {{ $operationType->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="montant_total">
                            <h3 id="montant_total"> 0 € </h3>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form">
                            <label> Date : </label>
                            <input name="date" type="date" class="form-control" value="{{$operation->date}}" required/>
                        </div>
                    </div>
                    <div>
                        <div class="form note">
                            <label> Note : </label>
                            <textarea name="note" class="form-control" placeholder="Ajouter des notes">{{$operation->note}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5> Billets </h5>
                <hr style="border : 1px solid #ffb100;" />

                <div class="">
                    <div class="content_item">
                        <div class="form">
                            <div> 
                                <label> Nominal : </label>
                                <select name="" class="form-select" id="nominalBillet">
                                    <option value="5"> 5 € </option>
                                    <option value="10"> 10 € </option>
                                    <option value="20"> 20 € </option>
                                    <option value="50"> 50 €</option>
                                    <option value="100"> 100 €</option>
                                    <option value="200"> 200 €</option>
                                    <option value="500"> 500 €</option>
                                </select>
                                <button type="button" id="btnAddBillets" class="btn btn-success mt-1"> Ajouter </button>
                            </div>
                            <div>
                                <label> Quantité : </label>
                                <input type="number" class="form-control" id="quantityBillet"/>
                            </div>
                            
                        </div>
                        <div class="listing">
                            <table class="table" id="table_billet">
                                <thead>
                                    <tr>
                                        <th scope="col">Nominal</th>
                                        <th>Quantité</th>
                                        <th>S/Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="montant_total">
                            <h3 id="subTotalBillet"> 0 € </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5> Pièces  </h5>
                <hr style="border : 1px solid #ffb100;" />

                <div class="">
                    <div class="content_item">
                        <div class="form">
                            <div> 
                                <label> Nominal : </label>
                                <select name="" class="form-select" id="nominalPiece">
                                    <option value="1"> 1 €</option>
                                    <option value="2"> 2 €</option>
                                </select>
                                <button type="button" id="btnAddPieces" class="btn btn-success mt-1"> Ajouter </button>
                            </div>
                            <div>
                                <label> Quantité : </label>
                                <input type="number" class="form-control" id="quantityPiece"/>
                            </div>
                            
                        </div>
                        <div class="listing">
                            <table class="table" id="table_piece">
                                <thead>
                                    <tr>
                                        <th scope="col">Nominal</th>
                                        <th>Quantité</th>
                                        <th>S/Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="montant_total" id="nominalPiece">
                            <h3 id="subTotalPiece"> 0 € </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h5> Centimes </h5>
                <hr style="border : 1px solid #ffb100;" />

                <div class="">
                    <div class="content_item">
                        <div class="form">
                            <div> 
                                <label> Nominal : </label>
                                <select name="" class="form-select" id="nominalCentime">
                                    <option value="0.01"> 1 cent </option>
                                    <option value="0.02"> 2 cent</option>
                                    <option value="0.05"> 5 cent</option>
                                    <option value="0.10"> 10 cent</option>
                                    <option value="0.20"> 20 cent</option>
                                    <option value="0.50"> 50 cent</option>
                                </select>
                                <button type="button" id="btnAddCentimes" class="btn btn-success mt-1"> Ajouter </button>
                            </div>
                            <div>
                                <label> Quantité : </label>
                                <input type="number" class="form-control" id="quantityCentime"/>
                            </div>
                            
                        </div>
                        <div class="listing">
                            <table class="table" id="table_centime">
                                <thead>
                                    <tr>
                                        <th scope="col">Nominal</th>
                                        <th>Quantité</th>
                                        <th>S/Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="montant_total">
                            <h3 id="subTotalCentime"> 0 € </h3>
                        </div>
                    </div>
                </div>
            </div>
            <input id="input_moneys" type="hidden" name="moneys" />

            <div class="mt-4" style="text-align: center">
                <button id="btnBack" class="btn btn-light btn_cancel"> Annuler </button>
                <button type="submit" class="btn btn-dark"> Enregistrer </button>
            </div>
        </form>
@endsection

@section('script')
  <script type="text/javascript">

    (function() {

        const moneysInputUpdate = <?php echo $moneys ?> ;

        const moneys = moneysInputUpdate.length > 0 ? moneysInputUpdate : [];  
        const MONEY_BILLET = <?php echo $MONEY_BILLET ?> ;
        const MONEY_PIECE = <?php echo $MONEY_PIECE ?> ;
        const MONEY_CENTIME = <?php echo $MONEY_CENTIME ?> ;


        initMoneys(moneys);

        $("#btnAddBillets").on('click', function() {
            const nominalBillet = Number($("#nominalBillet")[0].value);
            const quantityBillet = Number($("#quantityBillet")[0].value);
            if (nominalBillet && quantityBillet) {
                addMoneys(MONEY_BILLET, nominalBillet, quantityBillet)
            }
        })

        $("#btnAddPieces").on('click', function() {
            const nominalPiece = Number($("#nominalPiece")[0].value);
            const quantityPiece = Number($("#quantityPiece")[0].value);
            if (nominalPiece && quantityPiece) {
                addMoneys(MONEY_PIECE, nominalPiece, quantityPiece)
            }

        })

        $("#btnAddCentimes").on('click', function() {
            const nominalCentime = Number($("#nominalCentime")[0].value);
            const quantityCentime = Number($("#quantityCentime")[0].value);
            if (quantityCentime && quantityCentime) {
                addMoneys(MONEY_CENTIME, nominalCentime, quantityCentime)
            }

        })

        $("#btnBack").on('click', function() {
            history.back()
        })

        function initMoneys(moneys) {
            $("#input_moneys").attr('value',JSON.stringify(moneys));
            format(moneys);
        }
        function addMoneys(type, nominal, quantity) {
            moneys.push({type, nominal, quantity});
            $("#input_moneys").attr('value',JSON.stringify(moneys));
            format(moneys);
        }

        function format(moneys) {
            const billets = moneys.filter(x => x.type == MONEY_BILLET);
            const pieces = moneys.filter(x => x.type == MONEY_PIECE);
            const centimes = moneys.filter(x => x.type == MONEY_CENTIME);
            const cummulBillets = getCummul(billets);
            const cummulPieces = getCummul(pieces);
            const cummulCentimes = getCummul(centimes);

            insertToDom(cummulBillets, 'table_billet', 'subTotalBillet', MONEY_BILLET);
            insertToDom(cummulPieces, 'table_piece', 'subTotalPiece', MONEY_PIECE);
            insertToDom(cummulCentimes, 'table_centime', 'subTotalCentime', MONEY_CENTIME);

            //Get total

            $("#montant_total").text(getTotal(cummulBillets, cummulPieces, cummulCentimes) + " €");

            //handle undo event
            $(".btnDeleteRow").on('click', function() {
                undo($(this).attr('data-type'));
            })

        }
        

        function getCummul(moneys) {
            const result = {};
            for(const money of moneys) {
                if (!result[money.nominal]) {
                    result[money.nominal] = {
                        quantity : 0,
                        total : 0
                    };
                } 
                result[money.nominal].quantity += money.quantity;
                result[money.nominal].total += money.nominal * money.quantity;
            }
            return result;
        }

        function insertToDom(moneys, tableID, subTotalId, type) {
            $("#"+tableID+" tbody tr").remove();

            let subTotal = 0;

            for (const [key, value] of Object.entries(moneys)) {
                let dom = `<tr>`;
                dom += `<td> ${key} €</td>`;
                dom += `<td> ${value.quantity} </td>`;
                dom += `<td> ${value.total} € </td>`;
                dom += `<td> <i class="btnDeleteRow bi bi-arrow-counterclockwise" data-type="${type}"></i> </td>`;
                dom += `</tr>`;
                $("#"+tableID+" tbody").append(dom);

                subTotal += value.total;

            }    
            $("#"+subTotalId).text(subTotal + " €");

            
        }
        
        function getTotal(billets, pieces, centimes) {
            let total = 0;

            for (const [key, value] of Object.entries(billets)) {
                total += value.total;
            }

            for (const [key, value] of Object.entries(pieces)) {
                total += value.total;
            }

            for (const [key, value] of Object.entries(centimes)) {
                total += value.total;
            }

            return total;
        }

        function undo(type) {
            const index = moneys.findLastIndex(x => x.type == type);

            moneys.splice(index, 1);
            initMoneys(moneys);
        }

        function deleteR(type, nominal) {

        }

        

    })()

  </script>
@endsection