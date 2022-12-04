import Head from "next/head";
import styles from "../../styles/Home.module.css";
import { NextPage } from "next";
import { Card, Space } from "antd";
import NavBar from "../components/NavBar";

interface Client {
  name: string;
  address: string;
  deliveryDate: string;
  deliveryType: number;
  sum: number;
}

interface Props {
  clientList: [Client];
}

const LastDeliveries: NextPage<Props> = (props) => {
  return (
    <div className={styles.container}>
      <Head>
        <title>Deliveries</title>
        <meta name="description" content="Deliveries app" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <NavBar />

      <Space wrap>
        {props.clientList.map((client) => (
          <Card
            size="small"
            title={client.name}
            style={{ width: 500, margin: "10px", cursor: "default" }}
            hoverable={true}
          >
            <ul>
              <li>Adrese: {client.address}</li>
              <li>Datums: {client.deliveryDate}</li>
              <li>Tips: {getType(client.deliveryType)}</li>
              <li>Summa: {(client.sum / 100).toFixed(2)}</li>
            </ul>
          </Card>
        ))}
      </Space>
    </div>
  );
};

export async function getStaticProps() {
  const res = await fetch(`${process.env.BACKEND_URL}/deliveries/last`);
  const clientList = await res.json();
  return {
    props: {
      clientList,
    },
  };
}

function getType(n: number): string {
  switch (n) {
    case 1:
      return "Šķidrā prece";
    case 2:
      return "Cietā prece";
  }
  return "";
}

export default LastDeliveries;
