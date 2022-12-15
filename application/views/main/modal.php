<!-- modal notes -->
<div class="modal fade" id="notesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNotes" method="post">
                <div class="modal-body" style="padding: 0.25rem 1rem;">
                    <div class="row">
                        <div class="col mb-1">
                            <label for="exampleFormControlTextarea1" class="form-label">Notes</label>
                            <textarea class="form-control" name="notes" id="notes" maxlength="100" rows="3" placeholder="Example: Make my food spicy!" autofocus></textarea>
                        </div>
                        <div id="the-count" class="w-100">
                            <div class="badge rounded-pill bg-info">
                                <span id="current">0</span>
                                <span id="maximum">/100</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="transId" value="" />
                    <button type="submit" id="btnNotes" class="btn btn-dark">Save Notes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal addon -->
<div class="modal fade" id="addOnModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddOn" method="post">
                <div class="modal-body" style="padding: 0.25rem 1rem;">
                    <div class="row">
                        <div class="col mb-1">
                            <label for="exampleFormControlTextarea1" class="form-label">Add On</label>
                                <div id="showAddOn" class="grid grid-cols-1">

                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAddOn" class="btn btn-dark">Save Add On</button>
                </div>
            </form>
        </div>
    </div>
</div>