const axios = require('axios');

axios
  .get('http://localhost:8000/api/resumes/2', {
    headers: {
      Authorization: 'Bearer 3|bpKvBV58aayQqpMjjtyyOzsxfTAzhCsBGkboqypz',
    },
  })
  .then((res) => {
    console.log(res.data);
  })
  .catch((e) => {
    console.log(e.response.status);
    console.log(e.response.data);
  });
