<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="display:flex;align-item:center"  >
        <thead><h1>User-Invoice</h1></thead>
        <tbody>
            
                <tr style="color: white;background-color: aqua;font-size:xx-large">
                    <td>Invoice Id</td>
                    <td>Amount</td>
                    <td>Full Name</td>
                </tr>
            
            
                <?php foreach($invoice as $invc):?>
                    <tr style="font-size: x-large;">
                        <td style="color:aqua;"> <?= $invc['invoice_id'] ?></td>
                        <td style="color:green"> <?= $invc['amount'] ?></td>
                        <td style="color:red"> <?= $invc['full_name'] ?></td>
                    </tr>
                <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>