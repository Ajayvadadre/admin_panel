const response= await collection.aggregate([
    {
      "$group": {
        "_id": {
          "hour": { "$hour": "$date_time" },
          "type": "$type",
          "campaign_name": "$campaign_name",
          "process_name": "$process_name"
        },
        "call_count": { "$sum": 1 },
        "total_duration": { "$sum": "$duration" },
        "total_hold": { "$sum": "$hold" },
        "total_mute": { "$sum": "$mute" },
        "total_ringing": { "$sum": "$ringing" },
        "total_transfer": { "$sum": "$transfer" },
        "total_conference": { "$sum": "$conference" },
        "unique_calls": { "$addToSet": "$reference_uuid" }
      }
    },
    {
      "$project": {
        "hour": "$_id.hour",
        "type": "$_id.type",
        "campaign_name": "$_id.campaign_name",
        "process_name": "$_id.process_name",
        "call_count": 1,
        "total_duration": 1,
        "total_hold": 1,
        "total_mute": 1,
        "total_ringing": 1,
        "total_transfer": 1,
        "total_conference": 1,
        "unique_calls": { "$size": "$unique_calls" }
      }
    },
    {
      "$sort": { 
        "hour": 1
      }
    }
  ]).toArray()







 public function getMysqlHourly(){
        $ch = curl_init();
        $url = 'http://localhost:5000/mongo/report';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), true);
        $data['pageName'] = 'Hourly Report';
        $data['pageData'] = $response;
        // print_r($data);
        return view('user/dashboard',$data);
 }






 