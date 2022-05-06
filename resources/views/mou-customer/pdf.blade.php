<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  padding: 2em;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

</style>
</head>
<body>

<h2>Mou Details</h2>

<table>
    
  <tr>
    <td><strong>Customer</strong></td>
    <td>{{ $customer['full_name']}}</td>
  </tr>

  <tr>
    <td><strong>Code</strong></td>
    <td>{{ $mou['mou_code']}}</td>
  </tr>

  <tr>
    <td><strong>RO</strong></td>
    <td>{{ $mou['region']}}</td>
  </tr>

  <tr>
    <td><strong>ship to party code</strong>	</td>
    <td>{{ $mou['ship_to_party_code']}}</td>
  </tr>

  <tr>
    <td><strong>Group Company</strong>	</td>
    <td>{{ $mou['group_company']}}</td>
  </tr>

  <tr>
    <td><strong>Price Point</strong></td>
    <td>{{ $mou['price_point']}}</td>
  </tr>

  <tr>
    <td><strong>Major Grade</strong></td>
    <td>{{ $mou['major_grade']}}</td>
  </tr>

  <tr>
    <td><strong>CSS Period</strong></td>
    <td>{{ $mou['css_period']}}</td>
  </tr>

  <tr>
    <td><strong>Type</strong></td>
    <td>{{ $mou['mou_type']}}</td>
  </tr>

  <tr>
    <td><strong>Monthly Target</strong></td>
    <td>{{ $mou['monthly_target']}}</td>
  </tr>

  <tr>
    <td><strong>Quarterly Target</strong></td>
    <td>{{ $mou['quarterly_target']}}</td>
  </tr>

  <tr>
    <td><strong>Annual Target</strong></td>
    <td>{{ $mou['annual_target']}}</td>
  </tr>

  <tr>
    <td><strong>Monthly Rate</strong></td>
    <td>{{ $mou['monthly_rate']}}</td>
  </tr>

  <tr>
    <td><strong>Quarterly Rate</strong></td>
    <td>{{ $mou['quarterly_rate']}}</td>
  </tr>

  <tr>
    <td><strong>Annual Rate</strong></td>
    <td>{{ $mou['annual_rate']}}</td>
  </tr>

  <tr>
    <td><strong>From Date</strong></td>
    <td>{{ $mou['from_date']}}</td>
  </tr>

  <tr>
    <td><strong>To date</strong></td>
    <td>{{ $mou['to_date'] ?? '-'}}</td>
  </tr>

  <tr>
    <td><strong>Address</strong></td>
    <td>{{ $mou['address'] ?? '-'}}</td>
  </tr>

  <tr>
    <td><strong>Status</strong></td>
    <td>{{ $mou['status'] == 1 ? 'Active' : 'Inactive' }}</td>
  </tr>

</table>

</body>
</html>
