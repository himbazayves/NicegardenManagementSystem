<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <style>

.invoice-box {
  max-width: 800px;
  margin: auto;
  padding: 30px;
  border: 1px solid #eee;
  box-shadow: 0 0 10px rgba(0, 0, 0, .15);
  font-size: 16px;
  line-height: 24px;
  font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  color: #555;
}

.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
}

.invoice-box table td {
  padding: 5px;
  vertical-align: top;
}

.invoice-box table tr td:nth-child(n+2) {
  text-align: right;
}

.invoice-box table tr.top table td {
  padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
  font-size: 45px;
  line-height: 45px;
  color: #333;
}

.invoice-box table tr.information table td {
  padding-bottom: 40px;
}

.invoice-box table tr.heading td {
  background: #eee;
  border-bottom: 1px solid #ddd;
  font-weight: bold;
}

.invoice-box table tr.details td {
  padding-bottom: 20px;
}

.invoice-box table tr.item td{
  border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
  border-bottom: none;
}

.invoice-box table tr.item input {
  padding-left: 5px;
}

.invoice-box table tr.item td:first-child input {
  margin-left: -5px;
  width: 100%;
}

.invoice-box table tr.total td:nth-child(2) {
  border-top: 2px solid #eee;
  font-weight: bold;
}

.invoice-box input[type=number] {
  width: 60px;
}

@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
      width: 100%;
      display: block;
      text-align: center;
  }
  
  .invoice-box table tr.information table td {
      width: 100%;
      display: block;
      text-align: center;
  }
}

/** RTL **/
.rtl {
  direction: rtl;
  font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
  text-align: right;
}

.rtl table tr td:nth-child(2) {
  text-align: left;
}
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
          <tr class="top">
            <td colspan="4">
              <table>
                <tr>
                  <td class="title">
                    <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                  </td>
      
                  <td>
                    Invoice #: 123<br> Created: January 1, 2015<br> Due: February 1, 2015
                  </td>
                </tr>
              </table>
            </td>
          </tr>
      
          <tr class="information">
            <td colspan="4">
              <table>
                <tr>
                  <td>
                    Sparksuite, Inc.<br> 12345 Sunny Road<br> Sunnyville, CA 12345
                  </td>
      
                  <td>
                    Acme Corp.<br> John Doe<br> john@example.com
                  </td>
                </tr>
              </table>
            </td>
          </tr>
      
          <tr class="heading">
            <td colspan="3">
              Payment Method
            </td>
      
            <td>
              Check #
            </td>
          </tr>
      
          <tr class="details">
            <td colspan="3">
              Check
            </td>
      
            <td>
              1000
            </td>
          </tr>
      
          <tr class="heading">
            <td>
              Item
            </td>
      
            <td>
              Unit Cost
            </td>
      
            <td>
              Quantity
            </td>
      
            <td>
              Price
            </td>
          </tr>
          <tbody id="tbody">
          <tr class="item">
            <td>
              <input value="Website design" />
            </td>
      
            <td>
              $<input type="number" value="300" />
            </td>
      
            <td>
              <input type="number" value="1" />
            </td>
      
            <td>
              $300.00
            </td>
          </tr>
      
          <tr class="item">
            <td>
              <input value="Hosting (3 months)" />
            </td>
      
            <td>
              $<input type="number" value="75" />
            </td>
      
            <td>
              <input type="number" value="1" />
            </td>
      
            <td>
              $75.00
            </td>
          </tr>
      
          <tr class="item">
            <td>
              <input value="Domain name (1 year)" />
            </td>
      
            <td>
              $<input type="number" value="10" />
            </td>
      
            <td>
              <input type="number" value="1" />
            </td>
      
            <td>
              $10.00
            </td>
          </tr>
        </tbody >
          <tr>
            <td colspan="4">
              <button id="addBtn" class="btn-add-row">Add row</button>
            </td>
          </tr>
      
          <tr class="total">
            <td colspan="3"></td>
      
            <td>
              Total: $385.00
            </td>
          </tr>
        </table>
      </div>


      {{-- <style>
          $('table').on('mouseup keyup', 'input[type=number]', () => calculateTotals());

$('.btn-add-row').on('click', () => {
  const $lastRow = $('.item:last');
  const $newRow = $lastRow.clone();

  $newRow.find('input').val('');
  $newRow.find('td:last').text('$0.00');
  $newRow.insertAfter($lastRow);

  $newRow.find('input:first').focus();
});

function calculateTotals() {
  const subtotals = $('.item').map((idx, val) => calculateSubtotal(val)).get();
  const total = subtotals.reduce((a, v) => a + Number(v), 0);
  $('.total td:eq(1)').text(formatAsCurrency(total));
}

function calculateSubtotal(row) {
  const $row = $(row);
  const inputs = $row.find('input');
  const subtotal = inputs[1].value * inputs[2].value;

  $row.find('td:last').text(formatAsCurrency(subtotal));

  return subtotal;
}

function formatAsCurrency(amount) {
  return `$${Number(amount).toFixed(2)}`;
}
      </style> --}}




      <script>
        $(document).ready(function () {
    
        // Denotes total number of rows
        var rowIdx = 0;
    
        // jQuery button click event to add a row
        $('#addBtn').on('click', function () {
    
            // Adding a row inside the tbody.
            $('#tbody').append(`

            <tr class="item">
            <td>
              <input value="Domain name (1 year)" />
            </td>
      
            <td>
              $<input type="number" value="10" />
            </td>
      
            <td>
              <input type="number" value="1" />
            </td>
      
            <td>
              $10.00
            </td>
          </tr>
            
          `
                
                );
        });
    
        // jQuery button click event to remove a row.
        $('#tbody').on('click', '.remove', function () {
    
            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest('tr').nextAll();
    
            // Iterating across all the rows
            // obtained to change the index
            child.each(function () {
    
            // Getting <tr> id.
            var id = $(this).attr('id');
    
            // Getting the <p> inside the .row-index class.
            var idx = $(this).children('.row-index').children('p');
    
            // Gets the row number from <tr> id.
            var dig = parseInt(id.substring(1));
    
            // Modifying row index.
            idx.html(`Row ${dig - 1}`);
    
            // Modifying row id.
            $(this).attr('id', `R${dig - 1}`);
            });
    
            // Removing the current row.
            $(this).closest('tr').remove();
    
            // Decreasing total number of rows by 1.
            rowIdx--;
        });
        });
    </script>

</body>
</html>