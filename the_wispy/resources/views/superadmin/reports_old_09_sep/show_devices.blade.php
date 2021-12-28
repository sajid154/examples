      @if(sizeof($result) > 0)

        @foreach($result as $row)
          <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->child_name }}</td>
            <td>{{ $row->manufacturer }}</td>
            <td>{{ $row->plans['title'] }}</td>
            <td>{{ ucfirst($row->device_status) }}</td>
            <td>{{ ($row->payments['created_at'])?Carbon\Carbon::parse($row->payments['created_at'])->format('M d,Y, h:i:s A'):'' }}</td>
            <td>{{ ($row->device_start_date)?Carbon\Carbon::parse($row->device_start_date)->format('M d,Y, h:i:s A'):'' }}</td>
            <td>{{ ($row->device_end_date)?Carbon\Carbon::parse($row->device_end_date)->format('M d,Y, h:i:s A'):'' }}</td>
            <td>{{ ($row->device_expiration_date)?Carbon\Carbon::parse($row->device_expiration_date)->format('M d,Y, h:i:s A'):'' }}</td>
                <td>{{ $row->card_number_III }}</td>
                <td>{{ ($row->subscribed == 1)?'Active':'In-Active' }}</td>
                <td>{{ ($row->lastseen)?Carbon\Carbon::parse($row->lastseen)->format('M d,Y, h:i:s A'):'' }}</td>
            <td><a href="#" id="{{ $row->id }}" onclick="user_device_stats(this.id)" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Stats</a></td>
          </tr>
        @endforeach
      @else
      <tr>
          <td>{{ 'No Data Available' }}</td>
        </tr>
        @endif

