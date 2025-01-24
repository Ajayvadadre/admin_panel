const {MongoClient,ServerApiVersion, Db } = require("mongodb");
let uri =
  "mongodb+srv://ajayvadadre:ajayvadadre1234@nodemongocluster.1y5lp.mongodb.net/";
const client = new MongoClient(uri, {
  serverApi: {
    version: ServerApiVersion.v1,
    strict: true,
    deprecationErrors: true,
  },
});
let db;
async function connectDB() {
  try {
    await client.connect();
     db = client.db("admin");
    console.log(
      "Pinged your deployment. You successfully connected to MongoDB!"
    );
    // console.log(db)
    return db;
  } finally {
    await client.close();
  }
}

module.exports = {connectDB};
