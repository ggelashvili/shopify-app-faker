import { Banner, Layout, Page } from '@shopify/polaris'

const MissingApiKey = () => {
    return (
        <Page>
            <Layout>
                <Layout.Section>
                    <Banner title="Shopify API Key Is Missing" status="critical">
                        Shopify API Key is missing from the application.
                    </Banner>
                </Layout.Section>
            </Layout>
        </Page>
    )
}

export default MissingApiKey
