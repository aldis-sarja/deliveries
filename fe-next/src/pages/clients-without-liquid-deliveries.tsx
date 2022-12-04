import Head from "next/head";
import styles from "../../styles/Home.module.css";
import { NextPage } from "next";
import { Card, Space } from "antd";
import NavBar from "../components/NavBar";

interface Client {
  id: number;
  name: string;
  addresses: [Address];
}

interface Address {
  title: string;
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
              {client.addresses.map((address) => (
                <li>Adrese: {address.title}</li>
              ))}
            </ul>
          </Card>
        ))}
      </Space>
    </div>
  );
};

export async function getStaticProps() {
  const res = await fetch(
    `${process.env.BACKEND_URL}/clients/filter?noliquid=1`
  );
  const clientList = await res.json();
  return {
    props: {
      clientList,
    },
  };
}

export default LastDeliveries;
