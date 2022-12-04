import Link from "next/link";
import { useRouter } from "next/router";
import { Layout, Menu } from "antd";

const { Header } = Layout;

function NavBar() {
  const router = useRouter();
  return (
    <Layout>
      <Header>
        <Menu theme="dark" mode="horizontal" selectedKeys={[router.pathname]}>
          <Menu.Item key="/">
            <Link href="/">Klienti</Link>
          </Menu.Item>
          <Menu.Item key="/different-deliveries">
            <Link href="/different-deliveries">Pasūtījumu tipi</Link>
          </Menu.Item>
          <Menu.Item key="/last-deliveries">
            <Link href="/last-deliveries">Pēdējā piegāde</Link>
          </Menu.Item>
          <Menu.Item key="/clients-without-liquid-deliveries">
            <Link href="/clients-without-liquid-deliveries">
              Neaktīvie klienti
            </Link>
          </Menu.Item>
        </Menu>
      </Header>
    </Layout>
  );
}

export default NavBar;
